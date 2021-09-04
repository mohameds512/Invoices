


    $(document).ready(function(){
        $('select[name="section"]').on('change',function(){
            var section_id = $(this).val();
            if(section_id) {
                $.ajax({
                    url : "{{URL::to('section')}}/ "+ section_id,
                    type : "GET",
                    dataType : "json",
                    success: function(data){
                        $('select[name="products"]').empty();
                        $.each(data , function(key , value){
                            $('select[name="products"]').append('<option option value = "'+
                                value  +'">'  + value + '</option>' );
                        });
                    },
                });
            }
        })
    });

