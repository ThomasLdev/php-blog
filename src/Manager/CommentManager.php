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
                   c.created_at "comment_date",
                   c.content "comment_content",
                   c.status "comment_status",
                   u.first_name "author_first_name",
                   u.last_name "author_last_name"
                   FROM comment c
                   JOIN user u on c.author_id = u.id
                   WHERE c.status = 0
        ');
        $request->execute();
        $commentsSQL = $request->fetchAll();
        $comments = [];
        foreach ($commentsSQL as $commentSQL) {
            $comments[] = $this->hydrateComment($commentSQL);
        }
        return $comments;
    }

    public function getValidatedComments(): array
    {
        $request = $this->pdo->prepare('
        SELECT     c.id "comment_id",
                   c.created_at "comment_date",
                   c.post_id "post_id",
                   c.content "comment_content",
                   c.status "comment_status",
                   u.first_name "author_first_name",
                   u.last_name "author_last_name",
                   u.thumbnail "thumbnail"
        FROM comment c
        JOIN user u on c.author_id = u.id
        WHERE c.status = 1  
        ');
        $request->execute();
        $commentsSQL = $request->fetchAll();
        $validatedComments = [];
        foreach ($commentsSQL as $commentSQL) {
            $validatedComments[] = $this->hydrateComment($commentSQL);
        }
        return $validatedComments;
    }

    public function getPostComments(Post $post): array
    {
        $request = $this->pdo->prepare('
        SELECT     c.id "comment_id",
                   c.post_id "post_id",
                   c.author_id "comment_author",
                   c.created_at "comment_date",
                   c.content "comment_content",
                   c.status "comment_status",
                   u.first_name "author_first_name",
                   u.last_name "author_last_name"
                   FROM comment c
                   JOIN user u on c.author_id = u.id
                   WHERE c.post_id = :id
                   ORDER BY c.created_at DESC
        ');

        $request->execute(['id' => $post->getId()]);
        $commentsSQL = $request->fetchAll();
        $comments = [];
        foreach ($commentsSQL as $commentSQL) {
            $comments[] = $this->hydrateComment($commentSQL);
        }
        return $comments;
    }

    public function saveComment(Comment $comment)
    {
        $sendCommentRequest = $this->pdo->prepare('
                INSERT INTO comment 
                       (author_id, created_at,  content, status, post_id) 
                VALUES (:author, :createdAt, :content, :status, :postId)
        ');
        $sendCommentRequest->execute([
            'author' => $comment->getAuthorComment(),
            'createdAt' => $comment->getCreatedAt()->format('Y-m-d h:i:s'),
            'content' => $comment->getContent(),
            'status' => $comment->getStatus(),
            'postId' => $comment->getPostId()
        ]);
    }

    public function deleteComment(int $commentId)
    {
        $request = $this->pdo->prepare('DELETE FROM comment WHERE id = :id');
        $request->execute(array('id' => $commentId));
    }

    public function validateComment(int $commentId)
    {
        $request = $this->pdo->prepare('UPDATE comment SET status = 1 WHERE id = :id');
        $request->execute(['id' => $commentId]);
    }

    private function hydrateComment(array $commentSQL): Comment
    {
        $comment = new Comment();
        $comment->setId($commentSQL['comment_id']);
        $comment->setPostId($commentSQL['post_id']);
        $comment->setAuthorComment($commentSQL['author_first_name'] . ' ' . $commentSQL['author_last_name']);
        $comment->setCreatedAt((new DateTime($commentSQL['comment_date'])));
        $comment->setContent($commentSQL['comment_content']);
        $comment->setStatus($commentSQL['comment_status']);
        return $comment;
    }
}