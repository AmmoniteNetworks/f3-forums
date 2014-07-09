<?php 
namespace Forums\Models;

class Comments extends \Dsc\Mongo\Collection
{
   use \Dsc\Traits\Models\Ancestors;

    protected $__collection_name = 'forums.comments';

    protected $__type = 'forums.comments';

    protected $__config = array(
        'default_sort' => array(
            'metadata.created.time' => 1
        )
    );
    
    /**
     * Method to auto-populate the model state.
     *
     */
    public function populateState()
    {
        if ($this->getState('is.search')) 
        {
        	$this->setState('filter.published_today', true)->setState('filter.publication_status', 'published');
        }
        
        return parent::populateState();
    }

    protected function fetchConditions()
    {
        parent::fetchConditions();
        
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword&&is_string($filter_keyword))
        {
            $key = new \MongoRegex('/'.$filter_keyword.'/i');
            
            $where = array();
            
            $regex = '/^[0-9a-z]{24}$/';
            if (preg_match($regex, (string) $filter_keyword))
            {
                $where[] = array(
                    '_id' => new \MongoId((string) $filter_keyword)
                );
            }
            $where[] = array(
                'slug' => $key
            );
            $where[] = array(
                'title' => $key
            );
            $where[] = array(
                'copy' => $key
            );
            $where[] = array(
                'description' => $key
            );
            $where[] = array(
                'metadata.creator.name' => $key
            );
            
            $this->setCondition('$or', $where);
        }
        
        $filter_copy_contains = $this->getState('filter.copy-contains');
        if (strlen($filter_copy_contains))
        {
            $key = new \MongoRegex('/'.$filter_copy_contains.'/i');
            $this->setCondition('copy', $key);
        }
        
        $this->ancestorsFetchConditions();
      
        
        return $this;
    }
    
    /**
     *
     * @param string $unique
     * @return string
     */
    public function ancestorsGenerateSlug($unique = true)
    {
    	
    	$slug = \Web::instance()->slug($this->title);
    
    	if ($unique)
    	{
    		$base_slug = $slug;
    		$n = 1;
    		$parent = null;
    		if (isset($this->parent) && $this->parent != 'null')
    		{
    			$parent = $this->parent;
    		}
    
    		while ($this->ancestorsSlugExists($slug, $parent))
    		{
    			$slug = $base_slug . '-' . $n;
    			$n++;
    		}
    	}
    
    	return $slug;
    }

    public function beforeValidate()
    {
       
    	$this->ancestorsBeforeValidate();
        
        return parent::beforeValidate();
    }

    protected function beforeSave()
    {
      
        
        return parent::beforeSave();
    }
    
    protected function beforeUpdate()
    {
    	$this->ancestorsBeforeUpdate();
    
    	return parent::beforeUpdate();
    }

    protected function afterUpdate()
    {
    	$this->ancestorsAfterUpdate();
    
    	return parent::afterUpdate();
    }
}