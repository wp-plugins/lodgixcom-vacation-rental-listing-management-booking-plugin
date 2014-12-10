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
            <th colspan="1" style="text-align:center">
                <input type="checkbox" id="lodgix_rotate" onclick="javascript:lodgix_toggle_rotate();"
                <?php if ($this->options['p_lodgix_featured_rotate']) echo 'CHECKED'; ?>> Rotate
            </th>
        </tr>
    </tfoot>
</table>
