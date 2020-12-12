<?php

namespace App\Manager;
use App\Entity\Post;
use DateTime;
use PDO;

class PostManager extends Manager
{
    const POST_LIMIT = 5;

    public function getPosts(int $limit = null): array
    {
        $request = 'SELECT     p.id "post_id",
                   p.title "post_title",
                   p.created_at "post_date",
                   p.updated_at "post_update",
                   p.category "post_category",
                   p.content "post_content",
                   p.thumbnail "post_thumbnail",
                   u.first_name "post_author"
                   FROM posts p
                   JOIN user u on p.author_id = u.id
                   ORDER BY p.created_at DESC';
        if ($limit) {
            $request .= ' LIMIT 0, :limit';
        }

        $lastPostsRequest = $this->pdo->prepare($request);

        if ($limit) {
            $lastPostsRequest->bindValue(':limit', $limit, PDO::PARAM_INT);
        }

        $lastPostsRequest->execute();
        $postsSQL = $lastPostsRequest->fetchAll();
        $posts = [];
        foreach ($postsSQL as $postSQL)
        {
            $posts[] = $this->hydratePost($postSQL);
        }
        return $posts;
    }

    public function getPost(int $postId): Post
    {
        $singlePostRequest = $this->pdo->prepare('
            SELECT p.id "post_id",
                   p.title "post_title",
                   p.created_at "post_date",
                   p.updated_at "post_update",
                   p.category "post_category",
                   p.content "post_content",
                   p.thumbnail "post_thumbnail",
                   u.first_name "post_author"
                   FROM posts p
                   JOIN user u on p.author_id = u.id
                   WHERE p.id = :id');
        $singlePostRequest->execute(['id' => $postId]);
        $postSql = $singlePostRequest->fetch();
        return $this->hydratePost($postSql);
    }

    public function savePost(Post $post)
    {
        //Modifier pour soit insert soit update selon $post->getId()

        if ($post->getId() === null)
        {
            $sendPostRequest = $this->pdo->prepare('
                INSERT INTO posts 
                       (author_id, title, created_at, updated_at, category, content, thumbnail) 
                VALUES (:authorId, :title, :createdAt, :updatedAt, :category, :content, :thumbnail)
        ');
            $sendPostRequest->execute([
                'authorId' => $post->getAuthor(),
                'title' => $post->getTitle(),
                'createdAt' => $post->getCreatedAt()->format('Y-m-d h:i:s'),
                'updatedAt' => $post->getUpdatedAt()->format('Y-m-d h:i:s'),
                'category' => $post->getCategory(),
                'content' => $post->getContent(),
                'thumbnail' => $post->getThumbnail()
            ]);
        }
        $updateRequest = $this->pdo->prepare('
                UPDATE posts
                SET author_id = :authorId,
                    title = :title,
                    updated_at = :updatedAt,
                    category = :category,
                    content = :content,
                    thumbnail = :thumbnail
                WHERE id = :id');
        $updateRequest->execute([
            'authorId' => $post->getAuthor(),
            'title' => $post->getTitle(),
            'updatedAt' => $post->getUpdatedAt()->format('Y-m-d h:i:s'),
            'category' => $post->getCategory(),
            'content' => $post->getContent(),
            'thumbnail' => $post->getThumbnail(),
            'id' => $post->getId()
        ]);
    }

    public function deletePost(int $postId)
    {
        $singlePostRequest = $this->pdo->prepare('DELETE FROM posts WHERE id = :id');
        $singlePostRequest->execute(array('id' => $postId));
    }

    private function hydratePost(array $postSQL): Post
    {
        $post = new Post();
        $post->setId($postSQL['post_id']);
        $post->setAuthor($postSQL['post_author']);
        $post->setTitle($postSQL['post_title']);
        $post->setCreatedAt((new DateTime($postSQL['post_date'])));
        $post->setUpdatedAt((new DateTime($postSQL['post_update'])));
        $post->setCategory($postSQL['post_category']);
        $post->setContent($postSQL['post_content']);
        $post->setThumbnail($postSQL['post_thumbnail']);
        return $post;
    }
}