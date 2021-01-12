<?php
interface IRepository {
    /**
     * @param $params
     * @return boolean
     */
    public function exist($params);

    /**
     * @return object[]
     */
    public function getAll();

    /**
     * @param $id
     * @return object
     */
    public function getById($id);

    /**
     * @param $params
     * @return object
     */
    public function create($params);

    /**
     * @param $params
     * @return object
     */
    public function update($params);

    /**
     * @param $id
     * @return boolean
     */
    public function delete($id);
}
