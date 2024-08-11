<?php

class TarStreamWrapper
{
	private $position;
	private $tarData;
	private $mode;
	private $path;

	public function stream_open($path, $mode, $options, &$opened_path)
	{
		$this->position = 0;
		$this->path = $path;
		$this->mode = $mode;

		// Entferne das "tar://" Präfix vom Pfad
		$realPath = substr($path, 6);

		if ($mode === 'r' || $mode === 'r+') {
			$this->tarData = file_get_contents($realPath);
			return true;
		} elseif ($mode === 'w' || $mode === 'w+') {
			$this->tarData = '';
			return true;
		}

		return false;
	}

	public function stream_read($count)
	{
		$ret = substr($this->tarData, $this->position, $count);
		$this->position += strlen($ret);
		return $ret;
	}

	public function stream_write($data)
	{
		$len = strlen($data);
		$this->tarData = substr_replace($this->tarData, $data, $this->position, $len);
		$this->position += $len;
		return $len;
	}

	public function stream_tell()
	{
		return $this->position;
	}

	public function stream_eof()
	{
		return $this->position >= strlen($this->tarData);
	}

	public function stream_seek($offset, $whence)
	{
		switch ($whence) {
			case SEEK_SET:
				if ($offset < strlen($this->tarData) && $offset >= 0) {
					$this->position = $offset;
					return true;
				}
				break;
			case SEEK_CUR:
				if ($offset >= 0) {
					$this->position += $offset;
					return true;
				}
				break;
			case SEEK_END:
				if (strlen($this->tarData) + $offset >= 0) {
					$this->position = strlen($this->tarData) + $offset;
					return true;
				}
				break;
		}
		return false;
	}

	public function stream_metadata($path, $option, $value)
	{
		// Diese Methode könnte implementiert werden, um Metadaten zu ändern
		return false;
	}

	public function stream_stat()
	{
		// Rückgabe von Basis-Statistiken
		return [
			'dev' => 0,
			'ino' => 0,
			'mode' => 0644,
			'nlink' => 0,
			'uid' => 0,
			'gid' => 0,
			'rdev' => 0,
			'size' => strlen($this->tarData),
			'atime' => time(),
			'mtime' => time(),
			'ctime' => time(),
			'blksize' => -1,
			'blocks' => -1
		];
	}

	public function stream_close()
	{
		// Wenn im Schreibmodus, speichere die Änderungen
		if ($this->mode === 'w' || $this->mode === 'w+' || $this->mode === 'r+') {
			$realPath = substr($this->path, 6);
			file_put_contents($realPath, $this->tarData);
		}
	}
}

// Registriere den Stream-Wrapper
stream_wrapper_register("tar", "TarStreamWrapper");