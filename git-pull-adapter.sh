while true
do
	echo "[GitPull-Adapter] Started! Ctrl+C to stop [Every 2 seconds]"
	git pull github master
	sleep 2
done
