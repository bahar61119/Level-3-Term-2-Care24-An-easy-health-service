<script>
    var sh=1;
    function add_schedule()
    {
        sh++;
        var add='<div id="schedule_'+sh+'">';
        
        add+='<legend>Add Another Schedule</legend>';
        add+='<div class="form-group col-md-4">';
        add+='<label>Day</label>';
        add+='<select name="day'+sh+'" style="width:130px;">';

            add+=   '<option value= "Sat" >';
            add+=         '<?php echo "Sat"; ?></option>';

            add+=    '<option value= "Sun" >';
            add+=        ' <?php echo "Sun"; ?></option>'

            add+=    '<option value= "Mon" >';
            add+=     '    <?php echo "Mon"; ?></option>';
            add+=    ' <option value= "Tue" >';
            add+=         '<?php echo "Tue"; ?></option>';

            add+=    '<option value= "Wed" >';
            add+=         '<?php echo "Wed"; ?></option>';

            add+=   ' <option value= "Thu" >';
            add+=    '<?php echo "Thu"; ?></option>';
            add+=  ' <option value= "Fri" >';
            add+=   '<?php echo "Fri"; ?></option>';
                                  
            add+= '</select>';
            add+= '</div>';
            add+= '<div class="form-group col-md-11">';
            add+= '</div>';
            add+= '</br>';
         
            add+='</br>';
                
            add+='<label>Start Time</label>';
            add+='<select name="start_time_'+sh+'" style="width:130px;">';

            add+='<option value= "1" >';
            add+=    '<?php echo "1"; ?></option>';

            add+= '<option value= "2" >';
            add+= '<?php echo "2"; ?></option>';

            add+= '<option value= "3" >';
            add+= '<?php echo "3"; ?></option>';

            add+='<option value= "4" >';
            add+=  '<?php echo "4"; ?></option>';

            add+= '<option value= "5" >';
            add+= '<?php echo "5"; ?></option>';

            add+='<option value= "6" >';
            add+='<?php echo "6"; ?></option>';
            add+= '<option value= "7" >';
            add+='<?php echo "7"; ?></option>';

            add+= ' <option value= "8" >';
            add+=  '<?php echo "8"; ?></option>';

            add+= '<option value= "9" >';
            add+= '<?php echo "9"; ?></option>';

            add+='<option value= "10" >';
            add+=  '<?php echo "10"; ?></option>';

            add+= '<option value= "11" >';
            add+= '<?php echo "11"; ?></option>';

            add+=  '<option value= "12" >';
            add+=  '<?php echo "12"; ?></option>';
                                  
            add+= '</select>';
            add+='<select name="ts'+sh+'" style="width:130px;">';

            add+='<option value= "am" >';
            add+= '<?php echo "am"; ?></option>';

            add+=  '<option value= "pm" >';
            add+=  '<?php echo "pm"; ?></option>';
            add+= '</select>';
            add+='<label>Finish Time</label>';
            add+='<select name="finish_time_'+sh+'"  style="width:130px;">';

            add+=   '<option value= "1" >';
            add+=  '<?php echo "1"; ?></option>';

            add+='<option value= "2" >';
            add+='<?php echo "2"; ?></option>';

            add+='<option value= "3" >';
            add+='<?php echo "3"; ?></option>';

            add+= '<option value= "4" >';
            add+='<?php echo "4"; ?></option>';

            add+= '<option value= "5" >';
            add+= '<?php echo "5"; ?></option>';

            add+='<option value= "6" >';
            add+='<?php echo "6"; ?></option>';
            add+='<option value= "7" >';
            add+='<?php echo "7"; ?></option>';

            add+='<option value= "8" >';
            add+=     '<?php echo "8"; ?></option>';

            add+='<option value= "9" >';
            add+=     '<?php echo "9"; ?></option>';

            add+= '<option value= "10" >';
            add+=    ' <?php echo "10"; ?></option>';

            add+='<option value= "11" >';
            add+='<?php echo "11"; ?></option>';

                               add+='<option value= "12" >';
            add+='<?php echo "12"; ?></option>';
                                  
                               add+='</select>';
                               add+='<select name="tf'+sh+'" style="width:130px;">';

                               add+=  '<option value= "am" >';
                               add+= '<?php echo "am"; ?></option>';

                               add+='<option value= "pm" >';
                               add+='<?php echo "pm"; ?></option>';
                               add+=' </select>';
                               add+='</div>';
                               //add+='</div>'
                           $("#schedule_1").append(add); 
                       }
                       function remove_schedule()
                       {
                           if(sh>1)
                           {
                               var add ='#schedule_'+sh;
                               $(add).remove();
                               sh--;
                           }
                       }
</script>