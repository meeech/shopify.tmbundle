#!/usr/bin/env ruby
require 'rubygems'

if Gem.available?('liquid') === false
  puts "This feature requires the Ruby Gem liquid be installed.<br>"
  puts "Please see:<br>"
  puts "https://rubygems.org/gems/liquid"
  exit
end

require 'liquid'

require ENV['TM_BUNDLE_SUPPORT']+"/liquid/filters.rb"

# Inner liquid template
liquid_template = File.read( ENV['TM_PROJECT_DIRECTORY'] + "/templates/page.liquid" )

# current page content - pretty much flat html
content = { 
  'page' => { 
    'content' => File.read(ENV['TM_FILEPATH'])
  }
}

inner_content = Liquid::Template.parse(liquid_template).render(content)

# Need to figure out how to respect the layout set in the inner content
layout_template = File.read( ENV['TM_PROJECT_DIRECTORY'] + "/layout/theme.liquid" )

Liquid::Template.register_filter ShopFilter
final_content = Liquid::Template.parse(layout_template).render({
    'content_for_layout'=>inner_content,
    'template' => 'page',
    'page' => {
      'title' => `xattr -p title "#{ENV['TM_FILEPATH']}"`
    }
})

puts final_content
