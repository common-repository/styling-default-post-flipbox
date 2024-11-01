(function() {

	var categories=[
		{ text: 'Default', value:''}
	];
	var available_posts=[
		{ text: 'All', value:''}
	];
	
	for( x=1; x<=20; x++ ){
		categories.push(
			{text:'Layout '+x, value :'layout-'+x},
		);
	}
	var posts_ids = JSON.parse( fsdp_obj.post_id );
	var posts_titles = JSON.parse( fsdp_obj.post_title );

	for( x=0; x<=posts_ids.length; x++ ){
		let title = posts_titles[x]
		title = title == '' ? 'Untitled' : title; 
		available_posts.push(
			{
				text: title,
				value :posts_ids[x] },
		);
	}
	
	tinymce.PluginManager.add('fsdp_ec_button', function( editor, url ) {
		editor.addButton( 'fsdp_ec_button', {
			title: 'Flipboxes Shortcode Generator',
         	icon: 'icon flipbox-post-icon',
                onclick: function() {
                    editor.windowManager.open( {
				        title: 'Flipboxes Shortcode Generator',
				        body: [
							{
								type: 'listbox',
				            	name: 'layout',
								label: 'Layout',
				            	values: categories
							},
							{
				            	type: 'listbox',
				            	name: 'post_id',
				            	label: 'Single Post',
				            	values: available_posts
							},
				    	   	{
				            	type: 'textbox',
				            	name: 'limit',
				            	label: 'Maximum No. Of Post',
				            	value: '10'
							},
				           	{
								type: 'listbox',
								name: 'order',
								label: 'Post Order',
								values: [
									{text: 'DESC', value: 'DESC'},
									{text: 'ASC', value: 'ASC'},
								]
							},
				    	],
				        onsubmit: function( e ) {
				            editor.insertContent(
								'[fsdp-flipboxes layout="'+ e.data.layout +'" id="'+e.data.post_id+'" limit="'+ e.data.limit + '" order="'+ e.data.order +'"]'
				        	);
				        }
				    });
                }
        });
    });
})();