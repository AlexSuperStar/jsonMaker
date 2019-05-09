<?php

namespace alexstar;

/*
 * Author: Alexey Starikov <alexsuperstar@mail.ru>
 * https://github.com/AlexSuperStar/jsonMaker
 * Date: 06.06.2017
 * $a = new \alexstar\JsonMaker();
 * $cc='xyz';
 * $a->{$cc}->bbb->cccc[0]->xxx=5;
 * $a->{$cc}->zz='qq';
 * $a->xyz->zf='qq';
 * $a->xx->zz='qq';
 * echo $a; //{"xyz":{"bbb":{"cccc":[{"xxx":5}]},"zz":"qq","zf":"qq"},"xx":{"zz":"qq"}}
*/

class JsonMaker implements \ArrayAccess, \IteratorAggregate, \Countable
{
	private $_data = [];

	public function __construct($str = null)
	{
		if ($str) {
			if(is_string($str)){
				$data = json_decode($str);
				if (json_last_error()) throw new \Exception(json_last_error_msg());
				$this->parse($data);
			}else{
				$this->parse(json_decode(json_encode($str)));
			}
		}
	}

	public function parse($data)
	{
		if (is_object($data) || is_array($data)) {
			foreach ($data as $k => $v) {
				if (is_object($data)) {
					if (is_scalar($v)) {
						$this->$k = $v;
					} else {
						$this->$k->parse($v);
					}
				} elseif (is_array($data)) {
					if (is_scalar($v)) {
						$this[$k] = $v;
					} else {
						$this[$k]->parse($v);
					}
				}
			}
		}
	}

	# overloading
	public function __set($name, $value)
	{
		if (count($this->_data)) throw new \Exception('Property is array');
		$this->$name = $value;
	}

	public function &__get($name)
	{
		if (isset($this->$name)) {
			return $this->$name;
		} else {
			if (count($this->_data)) throw new \Exception('Property is array');
			$this->$name = new self();
			return $this->$name;
		}
	}

	public function __isset($name)
	{
		return isset($this->$name);
	}

	public function __unset($name)
	{
		unset($this->$name);
	}

	# Countable
	public function count()
	{
		return count($this->_data);
	}

	# ArrayAccess
	public function offsetSet($offset, $value)
	{
		if (count(get_object_vars($this)) > 1) throw new \Exception('Property is not array');
		if (is_null($offset)) {
			$this->_data[] = $value;
		} else {
			$this->_data[$offset] = $value;
		}
	}

	public function offsetExists($offset)
	{
		return isset($this->_data[$offset]);
	}

	public function offsetUnset($offset)
	{
		if (isset($this->_data[$offset])) {
			unset($this->_data[$offset]);
		}
	}

	public function &offsetGet($offset)
	{
		if (count(get_object_vars($this)) > 1) throw new \Exception('Property is not array');
		if (isset($this->_data[$offset])) {
			return $this->_data[$offset];
		} else {
			$this->_data[$offset] = new self();
			return $this->_data[$offset];
		}
	}

	public function toArray()
	{
		if (count($this->_data)) {
			return $this->processArray($this->_data);
		} else {
			$data = get_object_vars($this);
			unset($data['_data']);
			return $this->processArray($data);
		}
	}

	private function processArray($array)
	{
		foreach ($array as $key => $value) {
			if (is_object($value)) {
				$array[$key] = $value->toArray();
			} else {
				$array[$key] = $value;
			}
		}
		return $array;
	}

	public function toPrettyJson()
	{
		return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}

	public function __toString()
	{
		return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
	}

	# IteratorAggregate
	function getIterator()
	{
		if (count($this->_data)) {
			return new \ArrayIterator($this->_data);
		} else {
			return new \ArrayIterator($this);
		}
	}
}
?>