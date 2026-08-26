<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left"
    };
    $(document).ready(function() {
        $('#generalForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let submitBtn = form.find('button[type="submit"]');
            let originalBtnText = submitBtn.html();

            // Disable button and show loading state
            submitBtn.prop('disabled', true).html('<i class="ti ti-loader animate-spin me-1"></i> Saving...');

            $.ajax({
                url: "{{ route('settings.updateGeneral') }}",
                type: "POST",
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload(); // Reloads to reflect new values across layout
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    let errorMessage = "Failed to save general settings!";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    toastr.error(errorMessage);
                },
                complete: function() {
                    // Restore button state
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });
    });
</script>