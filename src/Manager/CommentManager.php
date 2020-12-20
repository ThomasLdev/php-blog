<?php

namespace App\Manager;
use App\Entity\Comment;
use App\Entity\Post;
use DateTime;

class CommentManager extends Manager
{
    public function getAllComments(): array
    {
        $request = $this->pdo->prepare('
        SELECT     c.id "comment_id",
                   c.post_id "post_id",
                   c.author_comment "comment_author",
                   c.created_at "comment_date",
                   c.content "comment_content",
                   c.status "comment_status"
                   FROM comment c
        ');
        $request->execute();
        $commentsSQL = $request->fetchAll();
        $allComments = [];
        foreach ($commentsSQL as $commentSQL)
        {
            $comments[] = $this->hydrateComment($commentSQL);
        }
        return $allComments;
    }

    public function getPostComments(Post $post): array
    {
        $request = $this->pdo->prepare('
        SELECT     c.id "comment_id",
                   c.post_id "post_id",
                   c.author_comment "comment_author",
                   c.created_at "comment_date",
                   c.content "comment_content",
                   c.status "comment_status"
                   FROM comment c
                   WHERE c.post_id = :id
                   ORDER BY c.created_at DESC
        ');

        $request->execute(['id' => $post->getId()]);
        $commentsSQL = $request->fetchAll();
        $comments = [];
        foreach ($commentsSQL as $commentSQL)
        {
            $comments[] = $this->hydrateComment($commentSQL);
        }
        return $comments;
    }

    public function saveComment(Comment $comment)
    {
        $sendCommentRequest = $this->pdo->prepare('
                INSERT INTO comment 
                       (author_comment, content) 
                VALUES (:authorId, :content)
        ');
    }


    private function hydrateComment(array $commentSQL): Comment
    {
        $comment = new Comment();
        $comment->setId($commentSQL['comment_id']);
        $comment->setPostId($commentSQL['post_id']);
        $comment->setAuthorComment($commentSQL['comment_author']);
        $comment->setCreatedAt((new DateTime($commentSQL['comment_date'])));
        $comment->setContent($commentSQL['comment_content']);
        $comment->setStatus($commentSQL['comment_status']);
        return $comment;
    }
}