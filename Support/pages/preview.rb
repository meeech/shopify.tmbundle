#!/usr/bin/env ruby
require 'rubygems'
require 'liquid'

# Inner liquid template
liquid_template = File.read( ENV['TM_PROJECT_DIRECTORY'] + "/templates/page.liquid" )

# current page content - pretty much flat html
content = { 'page' => { 'content' => File.read(ENV['TM_FILEPATH'])} }

inner_content = Liquid::Template.parse(liquid_template).render(content)

# Need to figure out how to respect the layout set in the inner content
layout_template = File.read( ENV['TM_PROJECT_DIRECTORY'] + "/layout/theme.liquid" )

final_content = Liquid::Template.parse(layout_template).render({'content_for_layout'=>inner_content})

puts final_content
