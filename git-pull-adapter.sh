echo "[GitPull-Adapter] Started! Ctrl+C to stop [Every 5 seconds]"
while true
do
	echo "[GitPull-Adapter] Updating master using git"
	git pull github master
	echo "[GitPull-Adapter] Updated! master brunch using git [ 5 seconds waiting ]"
	sleep 5
done
