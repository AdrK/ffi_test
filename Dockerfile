FROM fedora
RUN dnf install -y make gcc php-devel php-ffi
RUN dnf install -y git
RUN git clone --branch direct_from_mem --recursive https://github.com/AdrK/phpspy.git
RUN cd phpspy/vendor/termbox/ && make install
RUN ln -s /usr/local/lib/libtermbox.so /usr/lib64/libtermbox.so.1
RUN cd phpspy/ && USE_ZEND=1 make phpspy_dynamic -j4
RUN cp phpspy/libphpspy.so /usr/lib64/
COPY test.php ./test.php
CMD ["php", "./test.php"]
