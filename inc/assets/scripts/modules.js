jQuery(function($) {

    // Contact Form
    $( '#scmod-contact-form' ).submit( function (e) {
       
        e.preventDefault();
        
        $( '.mail-sent, .mail-not-sent' ).hide();
       
        var form = $( this );
        
        var name = $( '.name.control', form ).val();
        var email = $( '.email.control', form ).val();
        var message = $( '.message.control', form ).val();
        var recipient = $('.recipient', form ).val();
        var url = form.attr('action');
        
        if( name.length < 2 ) {
            alert( 'Please enter a name' );
            return false;
        }
        
        if( message.length < 2 ) {
            alert( 'Please enter a message' );
            return false;
        }
        
        if( ! scmodValidateEmail( email ) ) {
            alert( 'Please enter a valid email address' );
            return false;
        }
        
        var data = {
            
            action : 'scmod_send_message',
            name : name,
            email : email,
            message : message,
            recipient : recipient
            
        }
        
        $.post( url, data, function ( response ) {

            console.log( response );
            
            if ( response == 1 ) {
                $( '.mail-sent').fadeIn( 350 );
                form[ 0 ].reset();
            } else {
                $( '.mail-not-sent' ).fadeIn( 350 );
            }
            
        });
        
    });
    
    function scmodValidateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

});