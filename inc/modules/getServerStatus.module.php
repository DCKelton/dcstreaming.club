<script type="text/javascript">
    
    'use strict';
	
    function queryPlex (query) {
          return $.ajax({
          type: 'POST',
          url: 'inc/modules/plexAPI.module.php',
          cache: false,
          data: {'postData': query},
          dataType: 'json'
        });
    }

    
    $(document).ready(function () {
          getServerStatus();   
    });

    	
    function getServerStatus () {
  
         const serverStatusDiv = $('#server-status-msg'); 
         const getServerStatus = queryPlex('/');
         getServerStatus.done(function (data) {
                 if (data) {     
                 serverStatusDiv.html(' <i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fas fa-fw fa-check-circle" data-fa-transform="grow-4"></span></i>');
                } else {     
                 serverStatusDiv.html(' <i style="color:red; font-style:normal;"> &nbsp;OFFLINE <span style="color:red;" class="fas fa-fw fa-exclamation-circle" data-fa-transform="grow-4"></span></i>');
                }
            });
  
         getServerStatus.fail(function () {  
         serverStatusDiv.html(' <i style="color:red; font-style:normal;"> &nbsp;OFFLINE <span style="color:red;" class="fas fa-fw fa-exclamation-circle" data-fa-transform="grow-4"></span></i>');
                    }); 
  
}


   </script>
