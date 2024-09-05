<div>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <h1>UNSPSC Data</h1>

    <label for="segments">Segment:</label>
    <select id="segments">
        <option value="">Select a segment</option>
    </select>

    <label for="families">Family:</label>
    <select id="families">
        <option value="">Select a family</option>
    </select>

    <label for="classes">Class:</label>
    <select id="classes">
        <option value="">Select a class</option>
    </select>

    <label for="commodities">Commodity:</label>
    <select id="commodities">
        <option value="">Select a commodity</option>
    </select>

    <script>
        $(document).ready(function() {
            function trimToFirstSpace(value) {
                return value.split(' ')[0];
            }

            $.ajax({
                url: '/segment',
                method: 'GET',
                success: function(data) {
                    var options = data.map(function(item) {
                        return `<option value="${trimToFirstSpace(item)}">${item}</option>`;
                    }).join('');
                    $('#segments').append(options);
                }
            });

            $('#segments').on('change', function() {
                var segment = trimToFirstSpace($(this).val());
                if (segment) {
                    $.ajax({
                        url: '/family/' + encodeURIComponent(segment),
                        method: 'GET',
                        success: function(data) {
                            var options = data.map(function(item) {
                                return `<option value="${trimToFirstSpace(item)}">${item}</option>`;
                            }).join('');
                            $('#families').html('<option value="">Select a family</option>' + options);
                            $('#classes').html('<option value="">Select a class</option>');
                            $('#commodities').html('<option value="">Select a commodity</option>');
                        }
                    });
                } else {
                    $('#families').html('<option value="">Select a family</option>');
                    $('#classes').html('<option value="">Select a class</option>');
                    $('#commodities').html('<option value="">Select a commodity</option>');
                }
            });

            $('#families').on('change', function() {
                var family = trimToFirstSpace($(this).val());
                if (family) {
                    $.ajax({
                        url: '/class/' + encodeURIComponent(family),
                        method: 'GET',
                        success: function(data) {
                            var options = data.map(function(item) {
                                return `<option value="${trimToFirstSpace(item)}">${item}</option>`;
                            }).join('');
                            $('#classes').html('<option value="">Select a class</option>' + options);
                            $('#commodities').html('<option value="">Select a commodity</option>');
                        }
                    });
                } else {
                    $('#classes').html('<option value="">Select a class</option>');
                    $('#commodities').html('<option value="">Select a commodity</option>');
                }
            });

            $('#classes').on('change', function() {
                var classValue = trimToFirstSpace($(this).val());
                if (classValue) {
                    $.ajax({
                        url: '/comodity/' + encodeURIComponent(classValue),
                        method: 'GET',
                        success: function(data) {
                            var options = data.map(function(item) {
                                return `<option value="${trimToFirstSpace(item)}">${item}</option>`;
                            }).join('');
                            $('#commodities').html('<option value="">Select a commodity</option>' + options);
                        }
                    });
                } else {
                    $('#commodities').html('<option value="">Select a commodity</option>');
                }
            });
        });
    </script>
</div>