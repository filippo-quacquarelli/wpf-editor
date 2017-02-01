
(function( $ ) {

    function savePost(dataString) {
            
        $.ajax({
            type: "POST",
            url: wpfEditorData.ajax_url,
            data: dataString,
            error: function(jqXHR, textStatus, errorThrown){                                        
                console.error("The following error occured: " + textStatus, errorThrown);                                                       
            },
            success: function(data) {                                       
                successNotify( "Post saved :)" );
            }                         
        })
        .done( function( response, textStatus, jqXHR ) {
			console.log( 'AJAX done', textStatus, jqXHR, jqXHR.getAllResponseHeaders() );
		} )
		.fail( function( jqXHR, textStatus, errorThrown ) {
			console.log( 'AJAX failed', jqXHR.getAllResponseHeaders(), textStatus, errorThrown );
		} )
		.then( function( jqXHR, textStatus, errorThrown ) {
			console.log( 'AJAX after finished', jqXHR, textStatus, errorThrown );
		} );
    }

    var datapost = {
        id: wpfEditorData.post_id,

        content: function() {
            return $(".wpf-editor-content").html();
        }
    }

    var saveButton = MediumEditor.Extension.extend({
        name: 'save',

        init: function () {
            this.button = this.document.createElement('button');
            this.button.classList.add('medium-editor-save');
            this.button.innerHTML = 'S';
            this.button.title = 'Save post';

            this.on(this.button, 'click', this.handleClick.bind(this));
        },

        getButton: function () {
            return this.button;
        },

        handleClick: function (event) {
            var data = {
                action: 'post_content',
                id: datapost.id,
                content: datapost.content(),
            };
            
            savePost(data);
        }
    });
    

    var editor = new MediumEditor('.entry-content', {
        toolbar: {
            buttons: ['bold', 'h1', 'h2', 'h3', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'removeFormat', 'save'],
            diffTop: -35,
        },
        extensions: {
            'save': new saveButton()
        }
    });

    function successNotify( content ) {
        var container = $(".wpf-editor-notify");

        container.text(content).addClass("wpf-editor-visible");

        setTimeout(function() {
            container.text("").removeClass("wpf-editor-visible");
        }, 3000);
    }
})( jQuery );