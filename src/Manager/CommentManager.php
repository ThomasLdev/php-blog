<?php

namespace App\Manager;
use App\Entity\Comment;
use App\Entity\Post;
use DateTime;

class CommentManager extends Manager
{
    public function getPostComments(Post $post): array
    {
        $request = $this->pdo->prepare('
        SELECT     c.id "comment_id",
                   c.post_id "post_id",
                   c.author_comment_id "comment_author",
                   c.title "comment_title",
                   c.created_at "comment_date",
                   c.content "comment_content"
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

    private function hydrateComment(array $commentSQL): Comment
    {
        $comment = new Comment();
        $comment->setId($commentSQL['comment_id']);
        $comment->setPostId($commentSQL['post_id']);
        $comment->setAuthorCommentId($commentSQL['comment_author']);
        $comment->setTitle($commentSQL['comment_title']);
        $comment->setCreatedAt((new DateTime($commentSQL['comment_date'])));
        $comment->setContent($commentSQL['comment_content']);
        return $comment;
    }
}