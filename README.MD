# TM

## Web X Manager

* Pretty basic every day task manager.
* Easy to use and works on any webhost.

### X Manager Setup

Installation is simple, just drag the files into an empty directory on your webhost, for example `/htdocs/tm/`.
#### Requirements

* `PHP 7.4` - `PHP 8.1` Anything in between works (Tested on `PHP 8.1`)
* `Remote MYSQL Database` - For `List` and `Task` storage
* `PhpMyAdmin` In case something goes wrong

### Database Setup

First you have to login phpmyadmin then go to `SQL TAB` and paste this code
To execute this command press `CTRL + ENTER` on your keyboard
 
```sql
CREATE TABLE `tbl_lists` (
  `list_id` int(19) UNSIGNED NOT NULL,
  `list_name` varchar(50) NOT NULL,
  `list_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_tasks` (
  `task_id` int(10) UNSIGNED NOT NULL,
  `task_name` varchar(150) NOT NULL,
  `task_description` text NOT NULL,
  `list_id` int(11) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tbl_lists`
  ADD PRIMARY KEY (`list_id`);

ALTER TABLE `tbl_tasks`
  ADD PRIMARY KEY (`task_id`);

ALTER TABLE `tbl_lists`
  MODIFY `list_id` int(19) UNSIGNED NOT NULL AUTO_INCREMENT;
    
ALTER TABLE `tbl_tasks`
  MODIFY `task_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

```

### Check out my other project

* [Pinball Remastered X - Space cadet](https://github.com/Xan-Lua/PBX)

Thanks for visiting my project.