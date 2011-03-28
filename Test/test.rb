#!/usr/bin/env ruby
require 'rubygems'
require 'liquid'

# current page content
pcon = { 'page' => { 'content' => File.read(ENV['TM_FILEPATH'])} }

# Inner liquid template
liquid_template = File.read( ENV['TM_PROJECT_DIRECTORY'] + "/templates/page.liquid" )

puts Liquid::Template.parse(liquid_template).render(pcon)
# puts liquid_template
# ENV['TM_PROJECT_DIRECTORY']
# ENV['TM_FILEPATH']