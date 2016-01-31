<?php  return array (
  'redirector' => 'Redirector',
  'redirector.active' => 'Active',
  'redirector.desc' => 'Manage redirects for your website. Red lines mean that the pattern URL still exists OR target URL doesn\'t exist for a resource and will not be redirected.',
  'redirector.nothing_found' => 'No redirects found yet!',
  'redirector.description' => 'Description',
  'redirector.redirect_err_ae' => 'A redirect with that name already exists.',
  'redirector.redirect_err_ae_pattern' => 'A redirect with this pattern already exists.',
  'redirector.redirect_err_ae_patctx' => 'A redirect with this pattern and "[[+context]]" context already exists.',
  'redirector.redirect_err_ae_uri' => 'URI already exists for Resource ID [[+id]] in "[[+context]]" context... Redirect will not work!',
  'redirector.redirect_err_nf' => 'Redirect not found.',
  'redirector.redirect_err_ns' => 'Redirect not specified.',
  'redirector.redirect_err_ns_name' => 'Please specify a name for the redirect.',
  'redirector.redirect_err_ne_target' => 'Target URI doesn\'t exist... Redirect won\'t work...',
  'redirector.redirect_err_remove' => 'An error occurred while trying to remove the redirect.',
  'redirector.redirect_err_save' => 'An error occurred while trying to save the redirect.',
  'redirector.redirect_create' => 'Create New Redirect',
  'redirector.redirect_remove' => 'Remove Redirect',
  'redirector.redirect_remove_confirm' => 'Are you sure you want to remove this redirect?',
  'redirector.redirect_update' => 'Update Redirect',
  'redirector.redirect_view' => 'View Redirect',
  'redirector.redirects' => 'Redirects',
  'redirector.management' => 'Redirects Management',
  'redirector.menu_desc' => 'Manage your redirects.',
  'redirector.pattern' => 'Pattern',
  'redirector.search...' => 'Search...',
  'redirector.target' => 'Target',
  'redirector.context' => 'Context',
  'redirector.context_desc' => 'If context is set, redirect only affects on loaded context.',
  'redirector.triggered' => 'Triggered',
  'redirector.triggered_first' => 'First time triggered',
  'redirector.triggered_last' => 'Last time triggered',
  'redirector.import' => 'Import CSV',
  'redirector.import_desc' => 'Here you can import new rules provided in CSV format. You can upload a CSV file or paste raw CSV format in the textarea below.',
  'redirector.import.csv_desc' => 'Notice: format of the CSV must be "pattern;target;context", where "context" may be skipped or empty.<br/>Also; use relative URLs, do not include [[+site_url]] or similar ones.',
  'redirector.import.csv_file' => 'CSV File selection',
  'redirector.import.raw_csv' => 'Paste raw CSV data here',
  'redirector.import.do' => 'Start Import!',
  'redirector.import.doing' => 'Busy with importing CSV data...',
  'redirector.import.success' => 'Total [[+total]] records found. Imported: [[+succeed]] successful and [[+failed]] failed!',
  'redirector.import.failed' => 'Failed importing CSV data... Try again!',
  'redirector.regex_explain' => 'You can use regular expressions in the pattern and retrieve your replacements back in your target URL.

For example; you have many old URLs like "shop/category-{name}/" and you want to redirect all those URLs to the new "webshop/{name}/" structure, no problem!
Enter these values:

<b>Pattern:</b> ^shop\\/category-(.*)\\/$
<b>Target:</b> webshop/$1/

You can also apply more wildcards (.*) and use $2, $3 etc. And as you can see, you need to escape the forward slashes and define a ^ for the start and $ for the end position.',
  'setting_redirector.track_uri_updates' => 'Track URI Updates',
  'setting_redirector.track_uri_updates_desc' => 'If enabled, this will keep track on resource URI updates. Automatically creates redirects for old > new URIs.',
);