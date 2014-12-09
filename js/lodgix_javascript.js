/**
* @desc Lodgix
* @author Lodgix  - http://www.lodgix.com
*/

function p_lodgix_set_demo_credentials()
{
    jQueryLodgix('#p_lodgix_owner_id')[0].value = '13';
  	jQueryLodgix('#p_lodgix_api_key')[0].value = 'f89bd3b1bd098af107d727063c2736a6';
}

jQueryLodgix(document).ready(function(){

    jQueryLodgix("#p_lodgix_options").validate({
        rules: {
            p_lodgix_owner_id: {
            required: true
          },
          p_lodgix_api_key: {
            required: true
          }
        },
        messages: {
          p_lodgix_owner_id: {
            // the p_lodgix_lang object is define using wp_localize_script() in function p_lodgix_script() 
            required: p_lodgix_lang.required,
            number: p_lodgix_lang.number,
            min: p_lodgix_lang.min
          },
          p_lodgix_api_key: {
            // the p_lodgix_lang object is define using wp_localize_script() in function p_lodgix_script() 
            required: p_lodgix_lang.required
          }
        }
    });


    function lodgix_settings_tab_activate(element, container, callback) {
        var $active    = container.find('> .active')
        var transition = callback
          && jQueryLodgix.support.transition
          && (($active.length && $active.hasClass('fade')) || !!container.find('> .fade').length)
    
        function next() {
          $active
            .removeClass('active')
            .find('> .dropdown-menu > .active')
              .removeClass('active')
            .end()
            .find('[data-toggle="tab"]')
              .attr('aria-expanded', false)
    
          element
            .addClass('active')
            .find('[data-toggle="tab"]')
              .attr('aria-expanded', true)
    
          if (transition) {
            element[0].offsetWidth // reflow for transition
            element.addClass('in')
          } else {
            element.removeClass('fade')
          }
    
          if (element.parent('.dropdown-menu')) {
            element
              .closest('li.dropdown')
                .addClass('active')
              .end()
              .find('[data-toggle="tab"]')
                .attr('aria-expanded', true)
          }
    
          callback && callback()
        }
    
        $active.length && transition ?
          $active
            .one('bsTransitionEnd', next)
            .emulateTransitionEnd(Tab.TRANSITION_DURATION) :
          next()
    
        $active.removeClass('in');
      }

    function lodgix_settings_tab_show(el) {
        var $this    = el;
        var $ul      = $this.closest('ul:not(.dropdown-menu)');
        var selector = $this.data('target');
    
        if (!selector) {
          selector = $this.attr('href');
          selector = selector && selector.replace(/.*(?=#[^\s]*$)/, ''); // strip for ie7
        }
    
        if ($this.parent('li').hasClass('active')) return;
    
        var $previous = $ul.find('.active:last a');
        var hideEvent = jQueryLodgix.Event('hide.bs.tab', {
          relatedTarget: $this[0]
        });
        var showEvent = jQueryLodgix.Event('show.bs.tab', {
          relatedTarget: $previous[0]
        });
    
        $this.trigger(showEvent);
    
        if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) return
    
        var $target = jQueryLodgix(selector);
    
        lodgix_settings_tab_activate($this.closest('li'), $ul);
        lodgix_settings_tab_activate($target, $target.parent(), function () {
          $previous.trigger({
            type: 'hidden.bs.tab',
            relatedTarget: $this[0]
          })
          $this.trigger({
            type: 'shown.bs.tab',
            relatedTarget: $previous[0]
          });
        });
      }

    jQueryLodgix('.p_lodgix_settings_tabs a').click(function (e) {
        e.preventDefault()
        lodgix_settings_tab_show(jQueryLodgix(this));
    });

    var columns = [
        { "mDataProp": "order", "sClass": "index", "bSortable": true },
        { "mDataProp": "id", "sClass": "index", "bSortable": true },
        { "mDataProp": "name", "sClass": "index", "bSortable": true },
        { "mDataProp": "featured", "sClass": "top-dd", "bSortable": true }
    ];

    jQueryLodgix('#lodgix_properties_table').dataTable({        
		'bProcessing': true,
		'bServerSide': false,
		'sAjaxSource': p_lodgix_datatables.ajaxURL + '?action=p_lodgix_properties_list',
        "aoColumns": columns,
        "iDisplayLength": 50
    });

});
