$(document).ready(function () {

    $('form[name="contract"]').on('keyup change paste', 'input, select, textarea', function () {
        console.log($(this).val() + " -- " + $(this).attr('name'))
        var contract_days = $('#contract_days').val();
        var contract_daysExtension = $('#contract_daysExtension').val();
        var contract_car_id = $('#contract_car').val();

        if ($(this).attr('id') == "contract_discount" ||
            $(this).attr('id') == "contract_car" ||
            $(this).attr('id') == "contract_days" ||
            $(this).attr('id') == "contract_daysExtension" ||
            $(this).attr('name') == "contract[options][]"
        ) {


            if (contract_car_id && contract_days) {
                $.ajax({
                    url: Routing.generate('car_show', {id: contract_car_id}),
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (response) {
                    }
                }).always(function (response) {
                    var contract_carDaysAmountTotal = 0 ;
                    contract_carDaysAmountTotal += parseFloat(response.price) * parseFloat($('#contract_days').val());
                    contract_carDaysAmountTotal += parseFloat(response.price) * parseFloat($('#contract_daysExtension').val());
                    console.log(contract_carDaysAmountTotal);
                    $('#contract_carDaysAmount').val(contract_carDaysAmountTotal);
                    setFormContract();
                });
            } else {
                ($('#contract_carDaysAmount').val() ? $('#contract_carDaysAmount').val() : $('#contract_carDaysAmount').val(0));
            }

            var contract_options = $('#contract_options input[name="contract[options][]"]:checked');

            if (contract_options) {
                $.each(contract_options, function (index, value) {
                    // console.log(index + ": " + $(value).val());
                    var itemValue = $(value).val();
                    $.ajax({
                        url: Routing.generate('contract_option_show', {id: itemValue}),
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (response) {
                        }
                    }).always(function (response) {
                        if (index == 0) {
                            $('#contract_optionsAmount').val(0);
                        }
                        console.log("complete");
                        $('#contract_optionsAmount').val(parseFloat($('#contract_optionsAmount').val()) + parseFloat(response.price));
                        setFormContract();
                    });
                });
            }

            function setFormContract() {
                console.log("finsh");
                var contract_optionsAmount = isNaN(parseFloat($('#contract_optionsAmount').val())) ? 0 : parseFloat($('#contract_optionsAmount').val());
                var contract_carDaysAmount = isNaN(parseFloat($('#contract_carDaysAmount').val())) ? 0 : parseFloat($('#contract_carDaysAmount').val());

                $('#contract_amountTotaleHt').val(contract_optionsAmount + contract_carDaysAmount);
                var contract_amountTotaleTtc = (parseFloat($('#contract_tva').val()) / 100 + 1) * parseFloat($('#contract_amountTotaleHt').val());
                $('#contract_amountTotaleTtc').val(contract_amountTotaleTtc.toFixed(2));
                var contract_discount = isNaN(parseFloat($('#contract_discount').val())) ? 0 : parseFloat($('#contract_discount').val());
                var contract_discount_calc = (100 - contract_discount) / 100;
                var contract_amountTotaleTtcAfterDiscount = contract_amountTotaleTtc * contract_discount_calc;
                $('#contract_amountTotaleTtcAfterDiscount').val(contract_amountTotaleTtcAfterDiscount.toFixed(2));
                $('#contract_amountTotale').val(contract_amountTotaleTtcAfterDiscount.toFixed(2));
            }
        }
    });
});