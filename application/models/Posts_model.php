<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_post($postData) {
        $query = $this->db->insert('posts', $postData);
        $insert_id = $this->db->insert_id();
        $post = $this->db->where('id', $insert_id)->get('posts')->row();
        return $query ? $post : $this->db->error();
    }

    public function get_feed($session_token) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $session_token])->row();
        $user = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
        if($user) {
            $posts = $this->db->order_by("created_at", 'DESC')->get('posts')->result_array();
            foreach($posts as $key => $post) {
                $posts[$key]['user'] = $this->db->select('username, full_name, profile_picture')->get_where('users', ['id' => $post['user_id']])->row();
                $posts[$key]['is_liked'] = $this->db->get_where('likes', ['post_id' => $post['id'], 'user_id' => $user->id])->num_rows() == 1 ? true : false;
                $posts[$key]['total_likes'] = $this->db->get_where('likes', ['post_id' => $post['id']])->num_rows();
                $posts[$key]['total_comments'] = $this->db->get_where('comments', ['post_id' => $post['id']])->num_rows();
            }
            return $posts;
        } else {
            return false;
        }
    }

    public function get_post($post_id, $session_token) {
        $session_data = $this->db->get_where('sessions', ['session_token' => $session_token])->row();
        if($session_data) {
            $user_data = $this->db->get_where('users', ['id' => $session_data->user_id])->row();
            $post = $this->db->get_where('posts', ['id' => $post_id])->row();
            if($post) {
                $post->user = $this->db->select('username, full_name, profile_picture')->get_where('users', ['id' => $post->user_id])->row();
                $post->is_liked = $this->db->get_where('likes', ['post_id' => $post->id, 'user_id' => $user_data->id])->num_rows() == 1 ? true : false;
                $post->likes = $this->db->order_by('created_at', 'DESC')->get_where('likes', ['post_id' => $post->id])->result();
                $post->comments = $this->db->order_by('created_at', 'DESC')->get_where('comments', ['post_id' => $post->id])->result();

                foreach($post->likes as $key => $like) {
                    $post->likes[$key]->user = $this->db->select('username, full_name, profile_picture')->get_where('users', ['id' => $like->user_id])->row();
                }

                foreach($post->comments as $key => $comment) {
                    $post->comments[$key]->user = $this->db->select('username, full_name, profile_picture')->get_where('users', ['id' => $comment->user_id])->row();
                }

                return $post;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}