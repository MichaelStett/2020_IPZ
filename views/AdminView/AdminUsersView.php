<?php
require_once __DIR__ . '/../../autoload.php';


class AdminUsersView
{
    public static function render()
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
                <th scope="col">Email</th>
                <th scope="col">Options</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>gsae@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>gwe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>gthe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr><tr>
                <th scope="row">4</th>
                <td>Mark</td>
                <td>gsae@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>Jacob</td>
                <td>gwe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td>Larry</td>
                <td>gthe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr><tr>
                <th scope="row">7</th>
                <td>Mark</td>
                <td>gsae@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">8</th>
                <td>Jacob</td>
                <td>gwe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">9</th>
                <td>Larry</td>
                <td>gthe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr><tr>
                <th scope="row">10</th>
                <td>Mark</td>
                <td>gsae@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">11</th>
                <td>Jacob</td>
                <td>gwe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            <tr>
                <th scope="row">12</th>
                <td>Larry</td>
                <td>gthe@xy.z</td>
                <td>
                    <button class="btn"><i class="fa fa-trash"></i></button>
                    <button class="btn"><i class="fas fa-edit"></i></button>
                </td>
                <td>
                    <input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>
            </tr>
            </tbody>
        </table>

        <?= Layout::footer() ?>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}
?>