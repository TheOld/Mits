# -*- mode: ruby -*-
# vi: set ft=ruby :

#############################################
### Config Github Settings - Do not edit! ###
#############################################

github_username = "fideloper"
github_repo     = "Vaprobash"
github_branch   = "1.4.3"
github_url      = "https://raw.githubusercontent.com/#{github_username}/#{github_repo}/#{github_branch}"
github_pat          = ""

##########################################
# Server Configuration PLEASE UPDATE !!! #
##########################################

hostname        = "mmnz-2.dev"   # Provide a meaningful hostname related to the project. eg: heyday.dev
server_ip       = "192.168.22.56"     # Please check websites doc to see what's available and replace 'ip-address' with a new one
framework       = "silverstripe" # Please replace 'framework-name' with framework of the project. eg: silverstripe

###############
# VM Settings #
###############

server_cpus     = "2"   # Cores
server_memory   = "2084" # MB
server_swap     = "1000" # Options: false | int (MB) - Guideline: Between one or two times the server_memory
server_timezone  = "Pacific/Auckland"

##########################
# Database Configuration #
##########################

mysql_root_password   = "root"   # We'll assume user "root"
mysql_version         = "5.7"    # Options: 5.5 | 5.6
mysql_enable_remote   = "false"  # remote access enabled when true
pgsql_root_password   = "root"   # We'll assume user "root"
mongo_version         = "2.6"    # Options: 2.6 | 3.0
mongo_enable_remote   = "false"  # remote access enabled when true

##########################
# Languages and Packages #
##########################

php_timezone          = "Pacific/Auckland"    # http://php.net/manual/en/timezones.php
php_version           = "7.1"    # Options: 5.6 | 7.0 | 7.1
composer_packages     = [        # List any global Composer packages that you want to install
	"phpunit/phpunit:4.0.*",
	#"codeception/codeception=*",
	#"phpspec/phpspec:2.0.*@dev",
	#"squizlabs/php_codesniffer:1.5.*",
]

ruby_version          = "latest" # Choose what ruby version should be installed (will also be the default version)
ruby_gems             = [        # List any Ruby Gems that you want to install
	#"jekyll",
	#"sass",
	#"compass",
]

go_version            = "latest" # Example: go1.4 (latest equals the latest stable version)
hhvm                  = "false" # To install HHVM instead of PHP, set this to "true"

# Default web server document root
# Symfony's public directory is assumed "web"
# Laravel's public directory is assumed "public"
public_folder         = "/vagrant/source"

laravel_root_folder   = "/vagrant/laravel" # Where to install Laravel. Will `composer install` if a composer.json file exists
laravel_version       = "latest-stable" # If you need a specific version of Laravel, set it here
symfony_root_folder   = "/vagrant/symfony" # Where to install Symfony.


###########################
## Queuing and Searching ##
###########################

rabbitmq_user = "user"
rabbitmq_password = "password"
sphinxsearch_version  = "rel22" # rel20, rel21, rel22, beta, daily, stable
elasticsearch_version = "2.4.3"

###############################################################
## Actual Vagrant config - you probably shouldn't touch this ##
###############################################################

Vagrant.configure("2") do |config|

	# Set server to Ubuntu 14.04
	config.vm.box = "bento/ubuntu-16.04"

	config.vm.define hostname do |vapro|
	end

	if Vagrant.has_plugin?("vagrant-hostmanager")
		config.hostmanager.enabled = true
		config.hostmanager.manage_host = true
		config.hostmanager.ignore_private_ip = false
		config.hostmanager.include_offline = false
	end

	# Create a hostname, don't forget to put it to the `hosts` file
	# This will point to the server's default virtual host
	# TO DO: Make this work with virtualhost along-side xip.io URL
	config.vm.hostname = hostname

	# Create a static IP
	if Vagrant.has_plugin?("vagrant-auto_network")
		config.vm.network :private_network, :ip => "0.0.0.0", :auto_network => true
	else
		config.vm.network :private_network, ip: server_ip
	end

	# Enable agent forwarding over SSH connections
	config.ssh.forward_agent = true

	# Use NFS for the shared folder
	config.vm.synced_folder "..", "/vagrant",
		id: "core",
		:nfs => true,
		:mount_options => ['nolock,vers=3,udp,noatime,actimeo=2,fsc']

	# Replicate local .gitconfig file if it exists
	if File.file?(File.expand_path("~/.gitconfig"))
		config.vm.provision "file", source: "~/.gitconfig", destination: ".gitconfig"
	end

	# Allow the port 9200 to be open for elasticsearch and the module head
    config.vm.network :forwarded_port, host: 9200, guest: 9200
    # Allow the port 8025 for mailhog
    config.vm.network :forwarded_port, host: 8025, guest: 8025

	# If using VirtualBox
	config.vm.provider :virtualbox do |vb|

		vb.name = hostname

		# Set server cpus
		vb.customize ["modifyvm", :id, "--cpus", server_cpus]

		# Set server memory
		vb.customize ["modifyvm", :id, "--memory", server_memory]

		# Set the timesync threshold to 10 seconds, instead of the default 20 minutes.
		# If the clock gets more than 15 minutes out of sync (due to your laptop going
		# to sleep for instance, then some 3rd party services will reject requests.
		vb.customize ["guestproperty", "set", :id, "/VirtualBox/GuestAdd/VBoxService/--timesync-set-threshold", 10000]

		# Prevent VMs running on Ubuntu to lose internet connection
		vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
		vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]

	end

	# If using Vagrant-Cachier
	# http://fgrehm.viewdocs.io/vagrant-cachier
	if Vagrant.has_plugin?("vagrant-cachier")
		# Configure cached packages to be shared between instances of the same base box.
		# Usage docs: http://fgrehm.viewdocs.io/vagrant-cachier/usage
		config.cache.scope = :box

		config.cache.synced_folder_opts = {
				type: :nfs,
				mount_options: ['rw', 'vers=3', 'tcp', 'nolock']
		}
	end

	###########################################################
	## End of Vagrant config - now listing software          ##
	## uncomment to use - PHP Nginx MySQL enabled by default ##
    ###########################################################

	##############
	# Base Items #
	##############

	# Provision Base Packages
	config.vm.provision "shell", path: "#{github_url}/scripts/base.sh", args: [github_url, server_swap, server_timezone]
	config.vm.provision "shell", path: "#{github_url}/scripts/base_box_optimizations.sh", privileged: true

	# Provision PHP
	config.vm.provision "shell", path: "#{github_url}/scripts/php.sh", args: [php_timezone, hhvm, php_version]

	# Enable MSSQL for PHP
	# config.vm.provision "shell", path: "#{github_url}/scripts/mssql.sh"

	##################################
	# Web Servers - default is Nginx #
	##################################

	# Provision Apache Base
	# config.vm.provision "shell", path: "#{github_url}/scripts/apache.sh", args: [server_ip, public_folder, hostname, github_url]

	# Provision Nginx Base
	 config.vm.provision "shell", path: "#{github_url}/scripts/nginx.sh", args: [server_ip, public_folder, hostname, github_url]


	################################
	# Databases - default is MySQL #
	################################

	# Provision MySQL
	 config.vm.provision "shell", path: "#{github_url}/scripts/mysql.sh", args: [mysql_root_password, mysql_version, mysql_enable_remote]

	# Provision PostgreSQL
	# config.vm.provision "shell", path: "#{github_url}/scripts/pgsql.sh", args: pgsql_root_password

	# Provision SQLite
	# config.vm.provision "shell", path: "#{github_url}/scripts/sqlite.sh"

	# Provision RethinkDB
	# config.vm.provision "shell", path: "#{github_url}/scripts/rethinkdb.sh", args: pgsql_root_password

	# Provision Couchbase
	# config.vm.provision "shell", path: "#{github_url}/scripts/couchbase.sh"

	# Provision CouchDB
	# config.vm.provision "shell", path: "#{github_url}/scripts/couchdb.sh"

	# Provision MongoDB
	# config.vm.provision "shell", path: "#{github_url}/scripts/mongodb.sh", args: [mongo_enable_remote, mongo_version]

	# Provision MariaDB
	# config.vm.provision "shell", path: "#{github_url}/scripts/mariadb.sh", args: [mysql_root_password, mysql_enable_remote]

	# Provision Neo4J
	# config.vm.provision "shell", path: "#{github_url}/scripts/neo4j.sh"

	##########################################################
	# Search Servers - elasticsearch script is at the bottom #
	##########################################################

	# Install SphinxSearch
	# config.vm.provision "shell", path: "#{github_url}/scripts/sphinxsearch.sh", args: [sphinxsearch_version]

	############################################
	# Search Server Administration (web-based) #
	############################################

	# Install ElasticHQ
	# Admin for: Elasticsearch
	# Works on: Apache2, Nginx
	# config.vm.provision "shell", path: "#{github_url}/scripts/elastichq.sh"


	#######################################
	# In-Memory Stores - Redis as default #
	#######################################

	# Install Memcached
	# config.vm.provision "shell", path: "#{github_url}/scripts/memcached.sh"

	# Provision Redis (without journaling and persistence)
	 config.vm.provision "shell", path: "#{github_url}/scripts/redis.sh"

	# Provision Redis (with journaling and persistence)
	# config.vm.provision "shell", path: "#{github_url}/scripts/redis.sh", args: "persistent"
	# NOTE: It is safe to run this to add persistence even if originally provisioned without persistence


	###################
	# Utility (queue) #
	###################

	# Install Beanstalkd
	# config.vm.provision "shell", path: "#{github_url}/scripts/beanstalkd.sh"

	# Install Heroku Toolbelt
	# config.vm.provision "shell", path: "https://toolbelt.heroku.com/install-ubuntu.sh"

	# Install Supervisord
	# config.vm.provision "shell", path: "#{github_url}/scripts/supervisord.sh"

	# Install Kibana
	# config.vm.provision "shell", path: "#{github_url}/scripts/kibana.sh"

	# Install ØMQ
	# config.vm.provision "shell", path: "#{github_url}/scripts/zeromq.sh"

	# Install RabbitMQ
	# config.vm.provision "shell", path: "#{github_url}/scripts/rabbitmq.sh", args: [rabbitmq_user, rabbitmq_password]

	########################
	# Additional Languages #
	########################

	# Install Ruby Version Manager (RVM)
	# config.vm.provision "shell", path: "#{github_url}/scripts/rvm.sh", privileged: false, args: ruby_gems.unshift(ruby_version)

	# Install Go Version Manager (GVM)
	# config.vm.provision "shell", path: "#{github_url}/scripts/go.sh", privileged: false, args: [go_version]

	##########################
	# Frameworks and Tooling #
	##########################

	# Provision Composer
	# You may pass a github auth token as the first argument
	 config.vm.provision "shell", path: "#{github_url}/scripts/composer.sh", privileged: false, args: [github_pat, composer_packages.join(" ")]

	# Provision Laravel
	# config.vm.provision "shell", path: "#{github_url}/scripts/laravel.sh", privileged: false, args: [server_ip, laravel_root_folder, public_folder, laravel_version]

	# Provision Symfony
	# config.vm.provision "shell", path: "#{github_url}/scripts/symfony.sh", privileged: false, args: [server_ip, symfony_root_folder, public_folder]

	# Install Mailcatcher
	# config.vm.provision "shell", path: "#{github_url}/scripts/mailcatcher.sh"

	# Install Ansible
	# config.vm.provision "shell", path: "#{github_url}/scripts/ansible.sh"

	###################################################################################
	## Heyday scripts.                                                               ##
	## If there is a specific script you want to be ran, add it to the vagrant       ##
	## repository (https://git.heyday.net.nz/heyday/vagrant/) under the guest folder ##
	## and add a line to run it (it will be copied automatically)                    ##
	###################################################################################

	### Cloning our Vagrant repository ###
	config.vm.provision :host_shell do |host_shell|
         host_shell.inline = "git clone ssh://git@git.heyday.net.nz:1234/heyday/vagrant.git /tmp/#{hostname}/"
    end

    ### Running the pre script ###
	config.vm.provision :host_shell do |host_shell|
         host_shell.inline = "sh /tmp/#{hostname}/provisioning/heyday-setup-host-pre.sh #{hostname} #{server_ip}"
    end

    ### Making the DB import script executable ###
    config.vm.provision :host_shell do |host_shell|
         host_shell.inline = "sudo chmod +x /tmp/#{hostname}/provisioning/heyday-db-import"
    end

    ### Running the DB import script  - will fetch Live DB !###
    #config.vm.provision :host_shell do |host_shell|
    #     host_shell.inline = "/tmp/#{hostname}/provisioning/heyday-db-import"
    #end

    ### Copying scripts that need to be ran on guest VM ###
 	config.vm.provision :host_shell do |host_shell|
         host_shell.inline = "cp -R /tmp/#{hostname}/provisioning/guest ."
    end

    ### running main Heyday script on guest ###
	config.vm.provision "shell", inline: "sh /vagrant/source/guest/heyday-setup-guest.sh #{hostname} #{server_ip} #{framework}"

    ############################
	#### Framework setup ####
	############################
	config.vm.provision "shell", inline: "sh /vagrant/source/guest/heyday-framework-guest.sh #{hostname} #{php_version} #{framework}"

	## WKHTMLTOPDF
	config.vm.provision "shell", inline: "sh /vagrant/source/guest/heyday-wkhtmltopdf-guest.sh"

	### ELASTICSEARCH SCRIPT - Comment if not needed. Version at the top of this file ###
	config.vm.provision "shell", inline: "sh /vagrant/source/guest/heyday-elasticsearch-guest.sh #{elasticsearch_version}"
	### ELASTICSEARCH  mapper-attachments plugin ###
    config.vm.provision "shell", inline: "echo yes | sudo /usr/share/elasticsearch/bin/plugin install mapper-attachments"
    config.vm.provision "shell", inline: "sudo service elasticsearch restart"

	### Running the post script ###
    config.vm.provision :host_shell do |host_shell|
         host_shell.inline = "sh /tmp/#{hostname}/provisioning/heyday-setup-host-post.sh #{hostname} #{server_ip}"
    end
end
