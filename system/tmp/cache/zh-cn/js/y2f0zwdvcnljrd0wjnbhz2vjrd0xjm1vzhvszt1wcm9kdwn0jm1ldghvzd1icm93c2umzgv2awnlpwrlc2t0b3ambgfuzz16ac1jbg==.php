v.lang = {"confirmDelete":"\u60a8\u786e\u5b9a\u8981\u6267\u884c\u5220\u9664\u64cd\u4f5c\u5417\uff1f","deleteing":"\u5220\u9664\u4e2d","doing":"\u5904\u7406\u4e2d","loading":"\u52a0\u8f7d\u4e2d","updating":"\u66f4\u65b0\u4e2d...","timeout":"\u7f51\u7edc\u8d85\u65f6,\u8bf7\u91cd\u8bd5","errorThrown":"<h4>\u6267\u884c\u51fa\u9519\uff1a<\/h4>","continueShopping":"\u7ee7\u7eed\u8d2d\u7269","required":"\u5fc5\u586b","back":"\u8fd4\u56de","continue":"\u7ee7\u7eed","importTip":"\u53ea\u5bfc\u5165\u4e3b\u9898\u7684\u98ce\u683c\u548c\u6837\u5f0f","fullImportTip":"\u5c06\u4f1a\u5bfc\u5165\u6d4b\u8bd5\u6570\u636e\u4ee5\u53ca\u66ff\u6362\u7ad9\u70b9\u6587\u7ae0\u3001\u4ea7\u54c1\u7b49\u6570\u636e"};;v.path = [0];;v.categoryID = 0;;v.pageLayout = "global";;placebf32e3f19ffc63e6b9e5ef93291f86d2='IDLIST_PLACEHOLDER2,1,IDLIST_PLACEHOLDER';;$().ready(function() { $('#execIcon').tooltip({title:$('#execInfoBar').html(), html:true, placement:'right'}); }); ;$(document).ready(function()
{
    /* Set current active topNav. */
    var hasActive = false;
    if(v.categoryID > 0 && $('.nav-product-' + v.categoryID).length >= 1)
    {
        hasActive = true;
        $('.nav-product-' + v.categoryID).addClass('active');
    }

    if(v.categoryID > 0 && $('.nav-product-' + '0').length >= 1)
    {
      if(!hasActive)
      {
        hasActive = true;
        $('.nav-product-' + '0').addClass('active');
      }
    }
    if(v.categoryPath && v.categoryPath.length)
    {
        $.each(v.categoryPath, function(index, category)
        {
            if(!hasActive)
            {
                if($('.nav-product-' + category).length >= 1) hasActive = true;
                $('.nav-product-' + category).addClass('active');
            }
        });
    }
    else if(v.path && v.path.length)
    {
        $.each(v.path, function(index, category)
        {
            if(!hasActive)
            {
                if($('.nav-product-' + category).length >= 1) hasActive = true;
                $('.nav-product-' + category).addClass('active');
            }
        });
        if(!hasActive) $('.nav-product-0').addClass('active');
    }
    
    if(v.categoryID !== 0) $('#category' + v.categoryID).parent().addClass('active');
})
$(function()
{
    $('.media-placeholder').each(function()
    {
        var $this = $(this);
        $this.attr('style', 'background-color: hsl(' + $this.data('id') * 57 % 360 + ', 80%, 90%)');
    });

    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    $(document).on('click', '#modeControl a', function()
    {
        $('#modeControl a').removeClass('active');
        $(this).addClass('active');
        $('#modeControl').parents('.list-condensed').find('section').hide();
        $('#' + $(this).data('mode') + 'Mode').show();
        $.cookie('productViewType', $(this).data('mode'), {path: "/"});
    })

    var type = $.cookie('productViewType');
    if(typeof(type) == 'undefined' || type == '') type = 'card';
    $('#modeControl').find('[data-mode=' + type +']').click();

    $('.price').each(function()
    {
         if($(this).find('strong').length > 0)
         {
             $('.price').css('height', '30px');
             return false;
         }
    });
    
    var orderBy = $.cookie('productOrderBy' + v.categoryID);
    if(typeof(orderBy) != 'string')
    {
        orderBy = 'place_place';
    }

    var fieldName = orderBy.split('_')[0];
    var orderType = orderBy.split('_')[1];

    function setSorterClass()
    {
        if(orderType == 'asc')
        {
            $("[data-field=" + fieldName + "]").parent().removeClass('header').addClass('headerSortUp');
        }
        if(orderType == 'desc')
        {
            $("[data-field=" + fieldName + "]").parent().removeClass('header').addClass('headerSortDown');
        }
        $('#modeControl').find('[data-mode=' + type +']').click();
    }

    setSorterClass();
    $(document).on('click', '.setOrder', function()
    {
        if($(this).data('field') == fieldName)
        {
            orderType = orderType == 'asc' ? 'desc' : 'asc';
            fieldName = $(this).data('field');
        }
        else
        {
            orderType = 'desc';
            fieldName = $(this).data('field');
        }

        $.cookie('productOrderBy' + v.categoryID, fieldName + '_' + orderType);

        r = Math.random();
        url = config.requestType == 'GET' ? location.href + '&r=' + r + ' #products' : location.href + '?r=' + r + ' #products';
        $('#mainContainer').load(url, function(){ setSorterClass()});
    });

})

;
function loadCartInfo(twinkle)
{
    $('#siteNav').load(createLink('misc', 'printTopBar'),
        function()
        {
            if(twinkle) 
            {
                bootbox.dialog(
                {  
                    message: v.addToCartSuccess,  
                    buttons:
                    {  
                        back:
                        {  
                            label:     v.lang.continueShopping,
                            className: 'btn-primary',  
                            callback:  function(){location.reload();}  
                        },
                        cart:
                        {  
                            label:     v.gotoCart,  
                            className: 'btn-primary',  
                            callback:  function(){location.href = createLink('cart', 'browse');}  
                        }  
                    }  
                });
            }
        }
    );
}
