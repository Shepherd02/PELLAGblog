$(document).ready(function() {
        $('#search-data').unbind().keyup(function(e) {
          var value = $(this).val();
          if (value.length>3) {
            searchData(value);
          }
          else {
            $('#search-result-container').hide();
          }
        }
                                        );
      }
                       );
      function searchData(val){
        // clear out content in container
        $('#search-result-container').html("");
        $('#search-result-container').show();

        $.post('helpers/searchbar.php',{
          'search-data': val
        }, function(data){
            var parsedData = JSON.parse(data);

            if(parsedData.length) {
              for (var i = 0; i < parsedData.length; i++) {
                  var postTitle = parsedData[i][0];
                  var postId = parsedData[i][1];

                 $('#search-result-container').append("<div><a href='index.php?controller=Post&action=read&post_id=" + postId +"'>"+ postTitle + "</a></div>");
              }
            } else {
                $('#search-result-container').html("<div class='search-result'>No Result Found...</div>");
            }
        }
        ).fail(function(xhr, ajaxOptions, thrownError) {
          //any errors?
          alert(thrownError);
          //alert with HTTP error
        }
                    );
      }