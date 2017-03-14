<div class="row-fluid">
    <div class="col-md-12">
    <table class="table">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>User name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['firstname']; ?></td>
                <td><?php echo $user['lastname']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $roles[$user['role']]; ?></td>
                <td><a href="<?php echo base_url('/user/edit/'. $user['id']); ?>">Edit</a> | <a href="javascript: confirm_url('<?php echo base_url('/user/delete/'. $user['id']); ?>')">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<script type="text/javascript">
function confirm_url(url)
{
    if (confirm("Are you sure?"))
    {
        location.href = url;
    }
}
</script>