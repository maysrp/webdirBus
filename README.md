# webdirBus
webdir的离线下载公交车

将全部文件上传到你的web目录 ，安装好Aria2之后即可开公交车；

默认密码admin


设置crontab 用于排除大文件以及定时删除；

```
crontab -e
```
在最后添加:
```
* 0 * * * sh /home/wwwroot/magnet.di8.org/zero.sh 
*/1 * * * * php /home/wwwroot/magnet.di8.org/remove.php
```
#第一个表示每日凌晨执行
#第二个表示每一分钟执行
