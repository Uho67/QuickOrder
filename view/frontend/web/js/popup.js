define(['jquery',
    'Magento_Ui/js/modal/modal'],function ($, modal) {

    return function (config,node) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'Quick order',
            buttons: []
        };
        var slide = modal(options, $('#new_my_form'));


        node.onclick = function () {

            let popup_sku = document.getElementById('my_popup_sku');
            popup_sku.value = node.id;

            $.ajax({
                showLoader: true,
                url: '/mage/index.php/quick_order_frontend/save/customer',
                data: 'ajax=1',
                type: "POST",
                dataType: 'json',
                success:function (data) {//возвращаемый результат от сервера
                    if(data.result == 1) {

                        let my_mail = document.getElementById('my_email');
                        if(my_mail) {
                            my_mail.value = data.email;
                        }

                        let my_name = document.getElementById('my_name');
                        if(my_name) {
                            my_name.value = data.name;
                        }
                        let my_phone = document.getElementById('my_phone');
                        if(my_phone) {
                            my_phone.value = data.phone;
                        }

                    }
                    $('#new_my_form').modal('openModal');

                }

            })
        };

    }

});