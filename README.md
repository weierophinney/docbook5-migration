DocBook5 Migration Tools
========================

This repository groups together a number of bash and PHP scripts I've used in
order to convert DocBook 4 source files to DocBook 5. For a comprehensive
writeup of the motivations and rationale behind the various choices made here,
please read:

* http://weierophinney.net/matthew/archives/264-Converting-DocBook4-to-DocBook5.html

Requirements
------------

* bash or compatible shell
* xsltproc
* The db4-upgrade.xsl stylesheet; typically, installing libxml and/or xsltproc
  will provide this
* PHP >= 5.3.0, with the DOM extension enabled

Usage
-----

To convert a single file:

    prompt> path/to/docbook5-migration/bin/upgradeDocbook | tee -a error.log

To convert a tree of XML files in bulk:

    prompt> path/to/docbook5-migration/bin/upgradeDocbookBulk | tee -a error.log

You can then grep the error.log for the word "FAIL" to see where failures
occurred, and what caused them.

Configuration
-------------

If you want to skip certain files, edit the `bin/upgradeDocbook` file, and
update the "SKIPFILES" variable in it. Files listed in this string should not
include any path information.

Within this same file, you may provide alternate locations for such items as the
`db4-upgrade.xsl` stylesheet and potentially the various PHP scripts invoked for
transforming the converted files.

Disclaimer
----------

These scripts *will* overwrite your files; make sure your files are under
version control or that you have backups before using!

License
-------

Copyright (c) 2011, Matthew Weier O'Phinney
All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list
of conditions and the following disclaimer.

Redistributions in binary form must reproduce the above copyright notice, this
list of conditions and the following disclaimer in the documentation and/or
other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
