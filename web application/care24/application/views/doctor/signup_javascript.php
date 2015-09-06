  <script>
  var degree=1;
    function add_degree()
                {
		degree++;
	  //var add='<div id="degree_"'+degree+'>';
          var add='<div class="form-group col-md-4">';
            add+='<label> Name* </label>';
            add+='<input type="text" class=" form-control search-bar-size" placeholder="Degree Name" name="degree_name"'+degree+'>';
              add+='</div>';
           add+='<div class="form-group col-md-9">';
            add+='</div>';
	
            add+= '</br>';
             add+=' <div class="form-group col-md-4">'
            add+='<label>Institute*</label>'
            add+='<input type="text" class=" form-control search-bar-size" placeholder="Institute" name="institute"'+degree+'>';
             add+=' </div>';
            add+='<div class="form-group col-md-9">';
            add+='</div>';
	
             add+='</br>';
             //add+='</div>'
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