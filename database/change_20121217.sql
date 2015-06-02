-- Add a column to contain the patients' rating of sensation
ALTER TABLE `thought` ADD `sensation_response` INT( 3 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `sensation`;