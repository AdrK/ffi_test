<?php
$ffi = FFI::cdef(
	"int phpspy_init(int pid_i, void *err_ptr, int err_len);
	int phpspy_cleanup(int pid_i, void *err_ptr, int err_len);
	int phpspy_snapshot(int pid_i, void *ptr, int len, void *err_ptr, int err_len);",
    "libphpspy.so");

$err_buf = FFI::new("char[1024]");
$data_buf = FFI::new("char[1024]");
$ffi->phpspy_init(getmypid(), $err_buf, 1024);
$ffi->phpspy_snapshot(getmypid(), $data_buf, 1024, $err_buf, 1024);
$ffi->phpspy_cleanup(getmypid(), $err_buf, 1024);
var_dump(FFI::string($data_buf));
var_dump(FFI::string($err_buf));
?>