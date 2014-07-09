<div class="well">
<form id="settings-form" role="form" method="post" class="form-horizontal clearfix">

    <div class="clearfix">
        <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
    </div>
    
    <hr/>

    <div class="row">
        <div class="col-md-3 col-sm-4">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="#tab-home" data-toggle="tab"> Home View </a>
                </li>
                <li >
                    <a href="#tab-disqus" data-toggle="tab"> Disqus View </a>
                </li>
                <?php /* ?>
                <li>
                    <a href="#tab-general" data-toggle="tab"> General Settings </a>
                </li>
                */ ?>
                <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('tabs') as $key => $title ) { ?>
                <li>
                    <a href="#tab-<?php echo $key; ?>" data-toggle="tab"> <?php echo $title; ?> </a>
                </li>
                <?php } } ?>                
            </ul>
        </div>

        <div class="col-md-9 col-sm-8">

            <div class="tab-content stacked-content">

                <div class="tab-pane fade in active" id="tab-home">
                    <h3 class="">Home View Settings</h3>
                    <p class="help-block">The home view is the 'landing page' for your pages, available at <a href="./pages" target="_blank">/pages</a>.  It will include the latest pages from all your categories.</p>
                    <hr/>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Include Categories Widget</label>
                        
                        <div class="col-md-7">
                            <label class="radio-inline">
                                <input type="radio" name="home[include_categories_widget]" value="0" <?php if (!$flash->old('home.include_categories_widget')) { echo "checked"; } ?>> No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="home[include_categories_widget]" value="1" <?php if ($flash->old('home.include_categories_widget')) { echo "checked"; } ?>> Yes
                            </label>
                        </div>
                    </div>

                </div>
                
                 <div class="tab-pane fade in" id="tab-disqus">
                    <h3 class="">Disqus Settings</h3>
                    <hr/>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Include Categories Widget</label>
                        
                        <div class="col-md-7">
                           
                            <label> API Key</label>
                                <input type="text" name="disqus[api_key]" value="<?php echo $flash->old('disqus.api_key'); ?>" > 
                            
                            
                        </div>
                        <div class="col-md-7">
                           
                            <label> Secret Key</label>
                                <input type="text" name="disqus[secret_key]" value="<?php echo $flash->old('disqus.secret_key'); ?>" > 
                            
                            
                        </div>
                        <div class="col-md-7">
                           
                            <label> Access Token</label>
                                <input type="text" name="disqus[access_token]" value="<?php echo $flash->old('disqus.access_token'); ?>" > 
                            
                            
                        </div>
                    </div>

                </div>

                <?php /* ?>
                <div class="tab-pane fade in" id="tab-general">
                    <h3 class="">General Settings</h3>

                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec.</p>
                </div>
                */ ?>
                
                <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('content') as $key => $content ) { ?>
                <div class="tab-pane fade in" id="tab-<?php echo $key; ?>">
                    <?php echo $content; ?>
                </div>
                <?php } } ?>

            </div>

        </div>
    </div>

</form>
</div>