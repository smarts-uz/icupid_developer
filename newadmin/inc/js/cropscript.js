

// the target size
var TARGET_W = 600;
var TARGET_H = 300;


 var jq= jQuery.noConflict();
// show_popup : show the popup
function show_popup(id) {
	// show the popup
	jq('#'+id).show();
}

// close_popup : close the popup
function close_popup(id) {
	// hide the popup
	jq('#'+id).hide();
}



// show_popup_crop : show the crop popup
function show_popup_crop(url) {

    
    url="/uploads/thumbs/"+url;
    // change the photo source
	jq('#cropbox').attr('src',url );
	// destroy the Jcrop object to create a new one
	try {
		jcrop_api.destroy();
          
	} catch (e) {
          
	}
        //alert('hi');
	// Initialize the Jcrop using the TARGET_W and TARGET_H that initialized before
        //var jcrop_api = jq.Jcrop('#cropbox',{
    jq('#cropbox').Jcrop({
      aspectRatio: TARGET_W / TARGET_H,
      setSelect:   [ 100, 100, TARGET_W, TARGET_H ],
      onSelect: updateCoords
    },function(){
        jcrop_api = this;
    });
    
    // store the current uploaded photo url in a hidden input to use it later
	jq('#photo_url').val(url);
	// hide and reset the upload popup
	
	//jq('#loading_progress').html('');
	//jq('#photo').val('');

	// show the crop popup
	jq('#popup_crop').show();
}


// crop_photo : 
function crop_photo(domain) {

	var x_ = jq('#x').val();
	var y_ = jq('#y').val();
	var w_ = jq('#w').val();
	var h_ = jq('#h').val();
       document.getElementById('Loading_wait1').style.display="block"; 
	var photo_url_ = jq('#photo_url').val();

	// hide thecrop  popup
	jq('#popup_crop').hide();

	// display the loading texte

	// crop photo with a php file using ajax call
        
	jq.ajax({
		url: domain+'/newadmin/crop_photo.php',
		type: 'POST',
		data: {x:x_, y:y_, photo_url:photo_url_, targ_w:w_, targ_h:h_},
		success:function(data){
			// display the croped photo
			 
                    document.getElementById('Loading_wait1').style.display="none"; 
                        location.reload(); 

		},
 error: function (a, b, c) {
            console.log(a)
            console.log(b)
            console.log(c)
          document.getElementById('Loading_wait1').style.display="none"; 
              alert('photo cropping failed!');
        }
	});
}

// updateCoords : updates hidden input values after every crop selection
function updateCoords(c) {
	jq('#x').val(c.x);
	jq('#y').val(c.y);
	jq('#w').val(c.w);
	jq('#h').val(c.h);
}

