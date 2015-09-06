<hr/>    
<footer>
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-lg-12">
                <p><a href="#">Home</a> &middot; 
                    <a href="#">About</a> &middot; 
                    <a href="#">Help</a> &middot; 
                    <a href="#">Contact</a> &middot; 
                    <span class="pull-right hidden-sm"></span>
                </p>
                <a href="#">CARE24</a> is maintained by 
                <a href="http://www.codevictor.com">codevictor</a><br>
                Professionals-eye &nbsp;<span class="glyphicon glyphicon-copyright-mark"></span>&nbsp;2013
            </div>
        </div>   
    </div>
</footer>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/holder.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/twitter-bootstrap-hover-dropdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function() {
        $("#addli").css("background-color", "#339966")
    });</script>





<script>
    $(document).ready(function() {
        $('#habi').click(function() {

            var ni = document.getElementById('prescribe');
            var newdiv = document.createElement('div');
            var divIdName = 'my' + 1111 + 'Div';
            newdiv.setAttribute('id', divIdName);
            newdiv.innerHTML = 'Element Number ' + num + ' has been added! <a href=\'#\' onclick=\'removeElement(' + divIdName + ')\'>Remove the div "' + divIdName + '"</a>';
            ni.appendChild(newdiv);
        });
    });</script>

<SCRIPT language="javascript">
    var sh = 1;
    function remove() {
        if (sh > 1)
        {
            var add = '#new_med_' + sh;
            $(add).remove();
            sh--;
            if(sh<=1)
                {
                    document.getElementById("rmv").style.visibility = "hidden";
    
                }
        }
    }
 
    function add(type) {
 
if(sh>0){
    document.getElementById("rmv").style.visibility = "visible";
    

}    

//Create an input type dynamically.
//     
//   var element = document.createElement("input");
// 
//    //Assign different attributes to the element.
//    element.setAttribute("type", type);
//    //element.setAttribute("value", type);
//    //element.setAttribute("name", type);
//    element.setAttribute("class","form-control");
// 
//    var foo = document.getElementById("fooBar");
// 
//    //Append the element in page (in span).
//    foo.appendChild(element);
//

        var scntDiv = $('#fooBar');
        var i = $('#fooBar input').size() + 1;
//       $('#addScnt').live('click', function() {

//
//                var elem = $('<div><label>Medicine</label><div>');
//                $('<input style="width:200px;" type="text" id="as" class="form-control" placeholder="Medicine Name"/>').appendTo(elem);

//                         $('<input style="width:200px;"  type="text" class="form-control" id="exampleInputPassword1" placeholder="Medicine Name"/>').appendTo(elem);

        sh++;

        var elem = '<div id=new_med_' + sh + '><br><br><div class="input-group"><span class="input-group-addon"> Medicine Name </span>';

        elem += '<input style = "width:200px;" name="med'+sh+'" required="" type = "text" id="as" class="form-control" placeholder="Medicine Name">';
        elem += '<span class="input-group-addon"> Dose </span>';
        elem += '<input autocomplete="on" name="dose'+sh+'" required="" type="number" min="0" step="1" pattern="\d+" style="width:200px;" type="text" class = "form-control auto" placeholder = "Total dose quantity"></div>';
        elem += '<br>';
//                    $('<br>').appendTo(elem);
//                    $('<br>').appendTo(elem);
//                    $('<div></div>').appendTo(elem);                
//  
        elem += '<div class="input-group">';
        elem += '<span class = "input-group-addon"> Regulation: </span>';
        elem += '<span class = "input-group-addon">';
        elem += '<input style = "width:30px;" name="reg1'+sh+'" type = "checkbox">';
        elem += '<label> Morning </label>';
        elem += '<input type = "checkbox" name="reg2'+sh+'" text = "morning">';
        elem += '<label> Noon </label>';

        elem += '<input type = "checkbox" name="reg3'+sh+'" text = "morning">';
        elem += '<label> Night </label>';
        elem += '</span>';
        elem += '<div class = "btn-group">';
        elem += '<span class = "input-group-addon">';
        elem += '<label > Dose Time </label>';

        elem += '<select class = "btn-group" name="dosetime'+sh+'" id = "cat" class = "postform">';
        elem += '<option value = "After Meal"> After Meal </option>';
        elem += '<option class = "level-0" value = "Before Meal"> Before Meal </option>';
        elem += ' </select>';

        elem += '</span>';
        elem += '</div>';
        elem += '</div>';




        elem += '<br></div>';
//                    

        var removeLink = $(elem + '<br><Button>Remove</Button><br>').click(function() {
            $(elem).remove();
            $(this).remove();
        }).appendTo(elem);


        $("#fooBar").append(elem);
//                    $("#fooBar").append(removeLink);
// 
// $(document).on('click', '#remScnt', function(){ 
//                if( i > 2 ) {
//                        $(this).parents('#fooBar').size().remove();
//                        i--;
//                }
//                return false;
//        });
    }
</SCRIPT>



<script type="text/javascript">
    $(function() {

        //autocomplete
        $(".auto").autocomplete({
            source: "http://localhost/care24/index.php/search/search_medicine",
            minLength: 1
        });
    });
</script>


<!--

<Script>
$(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').size() + 1;
        
        $('#addScnt').live('click', function() {
                $('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
});
</Script>-->
<!--  <label for="exampleInputPassword1">Disease Detail</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Disease details according to patient">-->


<script>
    
  var degree=1;
    function add_degree()
                {
		degree++;
                var add='<div id="degree_'+degree+'">';
	   add+='<div class="form-group col-md-9">';
            
	 
          add+='<legend>Add Another Degree</legend>';
          add+='<div class="form-group col-md-5">';
            add+='<label> Name* </label>';
            add+='<input type="text" class=" form-control search-bar-size" placeholder="Degree Name" name="degree_name'+degree+'">';
              add+='</div>';
           add+='<div class="form-group col-md-9">';
            add+='</div>';
	
            add+= '</br>';
             add+=' <div class="form-group col-md-5">'
            add+='<label>Institute*</label>'
            add+='<input type="text" class=" form-control search-bar-size" placeholder="Institute" name="institute'+degree+'">';
             add+=' </div>';
            add+='<div class="form-group col-md-9">';
            add+='</div>';
	
             add+='</br>';
             add+='</div>';
             add+='</div>';
             $("#degree_1").append(add); 
	}
     function remove_degree()
           {
                    if(degree>1)
                    {
                        var add ='#degree_'+degree;
                        $(add).remove();
                        degree--;
                    }
                }
  </script>


</body>
</html>