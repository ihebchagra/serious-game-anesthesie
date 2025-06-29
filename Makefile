dev:
	@echo "Starting PHP development server..."
	php -S localhost:5050 -t ./ 2>&1 | grep -E -v "\[200\]|Accepted|Closing"

sync:
	@echo "Syncing with remote server..."
	@rsync -av --exclude-from='.rsyncignore' ./ iheb@iheb.tn:/var/www/seriousgame.iheb.tn/ --rsync-path="sudo rsync" --chown=www-data:www-data 

.PHONY: dev sync
