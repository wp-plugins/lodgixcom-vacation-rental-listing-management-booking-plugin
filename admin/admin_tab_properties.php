<br>
<table id="lodgix_properties_table" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Order</td>
            <th>ID</td>
            <th>Name</td>
            <th>Featured?</td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align:right"></th>
            <th colspan="1" style="text-align:center;white-space:nowrap;">
                <input type="checkbox" id="lodgix_select_all" onclick="javascript:lodgix_toggle_select_all();"
                <?php if ($this->options['p_lodgix_featured_select_all']) echo 'checked'; ?> style="margin:0"> Select All
            </th>
        </tr>
    </tfoot>
</table>
