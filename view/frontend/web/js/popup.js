define(['jquery',
    'Magento_Ui/js/modal/modal'],function ($, modal)
{
    return function (config,node)
    {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'Quick order',
            buttons: []
        };
        var slide = modal(options, $('#new_my_form'));
        node.onclick = function ()
        {
          document.getElementById('my_popup_sku').value = node.id;
          document.getElementById('my_email').value     = config.email;
          document.getElementById('my_name').value      = config.name;
          document.getElementById('my_phone').value     = config.phone;
          $('#new_my_form').modal('openModal');
        };

    }

});