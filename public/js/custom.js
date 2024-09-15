$(document).ready(function(){

    var current_fs, next_fs, previous_fs; // fieldsets
    var opacity;

    $(".next").click(function() {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        // Check if the current fieldset has empty inputs
        if (validateCurrentFieldset(current_fs)) {
            // Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            // Show the next fieldset
            next_fs.show();
            // Hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fieldset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                },
                duration: 600
            });
        } else {
            showErrorMessage('Lütfen tüm gerekli alanları doldurun.');
        }
    });

    $(".previous").click(function() {
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        // Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        // Show the previous fieldset
        previous_fs.show();

        // Hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fieldset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function() {
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function() {
        return false;
    });

    function validateCurrentFieldset(fieldset) {
        var isValid = true;
        var inputName = '';

        fieldset.find('input').each(function() {
            if ($(this).is(':checkbox') || $(this).is(':radio')) {
                inputName = $(this).attr('name');

                // Special handling for checkbox groups with limited selections
                if (inputName.includes('subject[]') || inputName.includes('character[]')) {
                    var checkedCount = fieldset.find(`input[name="${inputName}"]:checked`).length;
                    if (checkedCount <= (inputName.includes('subject[]') ? 3 : 3) && checkedCount !== 0) {
                        isValid = true; // Allow moving forward if within the limit
                    } else {
                        isValid = false; // Notify user if limit is exceeded
                        return false; // Exit loop
                    }
                }

                // Ensure that the checkbox group has at least one checked item
                if (inputName === 'location' && !fieldset.find('input[name="location"]:checked').length) {
                    isValid = false;
                }
            } else if ($(this).is('input[type="text"]')) {
                // Check if text fields are not empty
                if ($(this).val().trim() === '') {
                    isValid = false;
                }
            }
        });

        return isValid;
    }


    function handleCheckboxChange(checkboxes, maxSelection) {
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const checkedCount = document.querySelectorAll(`input[name="${checkbox.name}"]:checked`).length;

                // Ensure that no more than the allowed number of checkboxes are selected
                if (checkedCount > maxSelection) {

                    showErrorMessage(`You can only select up to ${maxSelection} ${checkbox.name === 'location[]' ? 'location[]' : 'items'}.`);
                    checkbox.checked = false;
                }

                // Update the label class based on checkbox state
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        cb.parentNode.classList.add('selected');
                    } else {
                        cb.parentNode.classList.remove('selected');
                    }
                });
            });

            // Ensure clicking on the label checks/unchecks the checkbox
            const label = checkbox.parentNode;
            label.addEventListener('click', () => {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            });
        });
    }

    const subjectCheckboxes = document.querySelectorAll('input[name="subject[]"]');
    const locationCheckboxes = document.querySelectorAll('input[name="location"]');
    const characterCheckboxes = document.querySelectorAll('input[name="character[]"]');

    handleCheckboxChange(subjectCheckboxes, 3);
    handleCheckboxChange(locationCheckboxes, 1);
    handleCheckboxChange(characterCheckboxes, 3);


    function showErrorMessage(messageText) {
        const errorMessageElement = document.getElementById('error-message');

        // Set the text of the message
        errorMessageElement.textContent = messageText;

        // Show the message
        errorMessageElement.style.display = 'block';

        // Wait for 5 seconds
        setTimeout(function() {
            // Hide the message after 5 seconds
            errorMessageElement.style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds
    }
});

