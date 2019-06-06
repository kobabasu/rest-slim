'use strict';

import gulp from 'gulp';
import DefaultRegistry from 'undertaker-registry';
import shell from '/usr/local/lib/node_modules/gulp-shell';

import { dir } from '../dir.js';

class Api extends DefaultRegistry {

  init() {
    // task名の接頭辞を設定
    const prefix = (dir.name == '') ? '' : dir.name + ':';

    /*
     * copy
     */
    gulp.task(prefix + 'api:copy', gulp.series(
      shell.task([`
        if [ ! -f ${dir.content + '/.htaccess.sample'} ]; then
          mkdir -p ${dir.content};

          cp -r ${dir.root + '/slimphp/*'} ${dir.content}/;
        fi
      `])
    ));
  }
};

module.exports = new Api();
