<?php
require_once __DIR__ . '/../../autoload.php';


class AdminUsersView
{
    public static function render($params = [])
    {
        ob_start();
        ?>
        <?= Layout::header(['userType' => "admin"]); ?>


        <table id="user_list" class="display" width="100%">
            <caption>List of users</caption>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Options</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($params as $key => $value) {

                $active = null;

                if ($value->getStatus()) {
                    $active = 'checked';
                }

                echo '<tr>
                    <th scope="row">' . $key . '</th>
                    <td>' . $value->getUsername() . '</td>
                    <td>' . $value->getFullName() . '</td>
                    <td>' . $value->getEmail() . '</td>
                    <td>
                        <button class="btn"><i class="fas fa-edit"></i></button>
                    </td>
                    <td>
                        <input type="checkbox" ' . $active.  ' data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                    </td>
                </tr>';
            }
            ?>
            </tbody>
        </table>

        <?= Layout::footer() ?>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}
