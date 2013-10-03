<div id="monitor"><img src="/images/load.gif"></div>



<script type="text/javascript">


function refresh() {
			
				$.getJSON('/getonline', function(json) {
					if(json.length) {				
						for(i=0; i < json.length; i++) {							
							$('#monitor').html(json[i].text);							
						}
					}
	            
				});
			timeoutID = setTimeout(refresh, 10000);				
}

refresh();
</script>