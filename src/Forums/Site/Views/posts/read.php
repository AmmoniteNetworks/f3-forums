HERE IS THE FORUM TEXTED
<div id="disqus_thread"></div>

<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: THIS CODE IS ONLY AN EXAMPLE * * */
    var disqus_shortname = 'buildingbermsgroup'; // Required - Replace example with your forum shortname
    var disqus_identifier = '<?php echo $item->id ?>';
    var disqus_title = '<?php echo $item->seoTitle(); ?>';
   // var disqus_url = '<?php echo $item->seoTitle(); ?>';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();

    var disqus_config = function() {

		this.callbacks.onNewComment = [function(comment) { 

			$.post("/forums/disqus/track", { comment: comment, post: "<?php echo $item->id ?>" }, function(result){

				alert(result);

			});

		}];
	};



    
</script>