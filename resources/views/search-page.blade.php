<form class="d-flex" role="search">
    <input class="form-control typeahead border border-secondary-subtle rounded-0"
        type="search" placeholder="Search" aria-label="Search">
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script>
    var path = "{{ route('auto-complete-search') }}";

    $('input.typeahead').typeahead({
        source: function(terms, process) {
            return $.get(path, {
                terms: terms
            }, function(data) {
                return process(data);
            });
        }
    });
</script>

