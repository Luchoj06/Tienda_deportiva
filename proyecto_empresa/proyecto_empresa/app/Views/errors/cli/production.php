<?php

// On the CLI, we still want errors in production
// so just use the exception template.

/* SonarCloud ignore: this include loads a view, not a namespaced class */
include __DIR__ . '/error_exception.php';
