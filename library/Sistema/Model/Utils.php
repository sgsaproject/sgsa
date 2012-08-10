<?php

/**
 * Description of Utils
 *
 * @author Rafael
 */
trait Sistema_Model_Utils {

    public function setAttributes(array $data = null) {
        if (empty($data) == false) {
            foreach ($data as $key => $value) {
                $array = explode('_', $key);
                array_map('ucfirst', $array);
                $key = implode('', $array);
                $method = 'set' . ucfirst($key);
                if (method_exists($this, $method) == false) {
                    throw new BadMethodCallException('Call to undefined method');
                }
                $this->{$method}($value);
            }
        }
    }

}
