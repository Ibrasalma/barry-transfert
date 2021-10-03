        </div>
    </div>
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/jQuery.print.js') }}"></script>

    <script>
        $(function() {
            $("#printable").find('.print').on('click', function() {
                $.print("#printable");
            });
        });
        $("#printable").print({

        // Use Global styles
        globalStyles : false, 

        // Add link with attrbute media=print
        mediaPrint : false, 

        //Custom stylesheet
        stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata", 

        //Print in a hidden iframe
        iframe : false, 

        // Manually add form values
        manuallyCopyFormValues: true,

        // resolves after print and restructure the code for better maintainability
        deferred: $.Deferred(),

        // timeout
        timeout: 250,

        // Custom title
        title: null,

        // Custom document type
        doctype: '<!doctype html>'

        });
    </script>
</div>