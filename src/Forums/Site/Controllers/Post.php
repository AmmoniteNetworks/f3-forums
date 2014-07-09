<?php 
namespace Forums\Site\Controllers;

class Post extends \Dsc\Controller 
{    
	use \Dsc\Traits\Controllers\SupportPreview;
	
	protected function getModel() 
    {
        $model = new \Forums\Models\Posts;
        return $model; 
    }
    
    public function read()
    {
    	// TODO Check ACL against page.
    	$slug = $this->inputfilter->clean( $this->app->get('PARAMS.slug'), 'cmd' );
    	$model = $this->getModel()->populateState()
            ->setState('filter.slug', $slug);
    	
    	$preview = $this->input->get( "preview", 0, 'int' );
    	if( $preview ){
    		$this->canPreview();
    	} else {
    		$model->setState('filter.published_today', true)
    		->setState('filter.publication_status', 'published');
    	}
    	    	
    	try {
    		$item = $model->getItem();
    		
    		if (empty($item->id))
    		{
    		    throw new \Exception;
    		}
    		
    	} catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item", 'error');
    		$this->app->error( '404' );
    		return;
    	}
    	
    	$this->app->set('item', $item );
    	
    	$this->app->set('meta.title', $item->seoTitle());
    	$this->app->set('meta.description', $item->seoDescription() );
    	    	
    	$view = \Dsc\System::instance()->get('theme');
    	
    	
    	
    	echo $view->renderTheme('Forums/Site/Views::posts/read.php');
    }
    
    public function track() {
    	$data = $this->input->getArray();
    	$settings = \Forums\Models\Settings::fetch();
    	$disqusApiSecret = $settings->{'disqus.secret_key'};
    	
    	// The new Disqus comment ID, which we'll look up to send with the notification
    	$commentId = $data['comment']['id'];
    	
    	// The article's post ID. Use anything that gives you a reliable signal to look up an author.
    	$postId = $data['post'];
    	
    	
    	// Use the posts/details endpoint to get comment content: http://disqus.com/api/docs/posts/details/
    	
    	$session = curl_init('http://disqus.com/api/3.0/posts/details.json?api_secret=' . $disqusApiSecret .'&post=' . $commentId . '&related=thread');
    	
    	
    	
    	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    	
    	$result = curl_exec($session);
    	
    	
    	
    	curl_close($session);
    	
    	// decode the json data to make it easier to parse the php
    	$results = json_decode($result);
    	
    	// Handle errors
    	if ($results === NULL) die('Error');
    	
    	
    	/**********************
    	 // Get the data we need
    	**********************/
    	
    	// Author and thread objects
    	$author = $results->response->author;
    	
    	$thread = $results->response->thread;
    	
    	$comment = $results->response->raw_message;
    	
    	
    	
    	$post = new \Forums\Models\Comments;
    	$post->set('postid', $postId );
    	$post->set('comment', $results->response);
    	$post->store();
    }
}