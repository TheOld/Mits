# Less Standards

> See BEM and Style Guide standards below

Less fun; more less, less confusion.


### File Structure

### General files
**core/layout.less**
The layout file is for high level layout based styles. These will largely be the grid and any container styles required.

**core/typography.less**
The typography file is for type styles. These will be defined as modules so that the styles can be easily extended in later phases of the project.

For more specific instructions see Modular typography styles

### Module files
**modules/module.less**
Every module or block level component that is created within a project should have it's own designated file. The file should be named the same as the module itself and only include styles specific to said module.

### Utility files
**variables.less**
The variables file is to house global variables and make them accessible from each of the general or module files. This includes the basic grid structure, breakpoints, theme colours and the `/themes` directory reference.

The variables file and the typography file are combined in the editor.less file which is included in Silverstripe to add theme styles to the WYSIWYG editor.

**mixins.less**
The mixins file is for all global mixins that are used for things such as vendor prefixing or fixes. Mixins that are specific to a module or section should go into their respective files. Mixins in this file need not be prefixed with the file code.

**core/helpers.less**
The helpers file is for classes that would be considered helpers. They are element agnostic and perform a specific task that is oft repeated within a project.

**core/print.less**
The print file is the default styles that are used for printing. This is primarily from the HTML5BP.

### Generate files
**style.less**
The style file is used to import all other files and generate the base style.css file. Any project specific comments should not be added in the head block comment in this file, but rather the themes base README.md file

**style-min.less**
The style-min file is used to generate the minified css used in production.

___

# BEM

Here lies BEM naming conventions specific to Heyday projects and basic CSS/Markup standards.


**Background (if you're interested)**

BEM naming conventions are based on //Block, Element, Modifier// structure. A quick google will return the following:

```
.block {
  .block__element {
  }
  &.block--open {
  }
}
```
and if you want even //more// info, go here: http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/


**Some basic standards**

There is more to BEM than a descriptive way to name modules and elements. There are some important things to note in the structure of your markup, and also the structure in your less. 

First of all, your Block module should have an overarching name specific to that block, not specific to the location on the page it lies. For example, we have a search field in the header:

```
<div class="header header--fixed">
  <div class="searchform" />
</div>
```
and your less file?

```
.header {
  .searchform {
  }
}
```
Holy hell is this ever so wrong! What happens when the client decides the search is best off in the footer??? What we need is two seperate modules; .header and .searchform. Each should have it's own specific less file.

```
.header {
  &.header--fixed {
  }
}
```

```
.searchform {
  .searchform__input {
  }
}
```

Second, each child of that block should be prefixed with *block-name*__ .

And third, each modifier of any element needs the prefix of that elements class. 

Note that the majority of modifiers should happen //at block level//. That is, the overarching parent should hold the state of the block, child deviations can all be based off this modifier, with the exception of elements with siblings. ie a current page link in a ul: list_ _item list_ _item--current

**"How is Markup effected?" I hear you mull in your headspace**

Class names should be clearly grouped at a block level. Ideally it would be nice to have these ordered by specificity. 
[ "Element" "Modifier" ]* [ "Block"/"Element" "Modifier" ] [ "Layout" ] [ "Typography" ]
*where this block is also an element of another block
For example (this is overly complicated for a reason):

```
<div class="sidebar sidebar--inactive layout__padding--bottom type">
  <h3 class="sidebar__label type--dark">
    Cookbooks
  </h3>
  <ul class="sidebar__list nav nav--vertical nav--sidebar type--center">
    <li class="nav__item">
      Dinners for singles
    </li>
    <li class="nav__item nav__item--current">
      Eating alone again
    </li>
    <li class="nav__item">
      How to make a lasagne for one
    </li>
  </ul>
  <h3 class="sidebar__label type--dark">
    Friendzoned
  </h3>
  <ul class="sidebar__list type--center">
    <li>
      We can make it together!
    </li>
  </ul>
</div>
``` 
From this we can easily denote that this is a sidebar. It's state is inactive. It has two children: .sidebar_ _label, sidebar_ _list. It has a bit of padding at the bottom and inherits the default .type styles (formerly .t-content)
One ul has styles specific to this sidebar block, however is also a module that may also be used in the header and this is the vertical version of that module.
It has three children, one of which has an active state.

As far as less is structured, both of the modules .sidebar and .nav have separate less files and are considered independent of each other. With that said, in this particular case there is opportunity to bridge the two modules. That is, if we have specific changes to .nav elements that only apply when this block is used as a child of .sidebar. 

```
.sidebar .nav {
  // Specific styling
}
```
> NOTE: that this breaks out of the concept of modules and creates a bit of a conflict mess (does this code go in sidebar.less or nav.less???) and opens the door to element specificity issues. Therefore, this approach is to be used only in very specific circumstances. A much more ideal approach would be to create a modifier of .nav which can be used in this scenario ( and potentially again elsewhere ), ie nav--sidebar.


**Specificity and nesting**

This one goes a bit without saying, but we should be nesting each element within a block //as if they were siblings//. 

What is nice and avoids bad specificity but is still easy to read:

```
.heyday {
  .heyday__mr1 {
    border: 1px solid white;
    padding: ~2m ~3m;
  }
  .heyday__mr3 {
    border: 1px solid white;
    border-bottom: 1px solid autumn-orange;
    padding: 0px;
  }
  .heyday__meetingchair {
    color: blue-ish;
    comfort: 0;
  }
  .heyday__table {
    color: white;
    height: @only-just-enough;
  }
  .heyday__mr1--used {
    .heyday__table {
      content: 'empty glasses, half-done water, coffee cups etc';
    }
    .heyday__meetingchair {
      temperature: @warm-and-awkward;
    }
  }
  .heyday__mr1--cleaned {
    .heyday__table {
      content: 'chocolates';
    }
  }
}
```
bad specificity: 

```
.heyday {
  .heyday__mr1 {
    &.heyday__mr1--inuse {
      .heyday__table {
        .heyday__meetingchair {
          content: 'someones butt';
        }
      }
    }
  }
}
```
What the flip, this is cray. 
Reasons why this is bad:
 1, it is.

What happens on .heyday--awayday??? The content: in .heyday_ _meetingchair will be ''; but how to we override this mess?

```
.heyday {
  &.heyday--awayday {
    .heyday__mr1 {
      .heyday__table {
        .heyday__meetingchair {
          content: '';
        }
      }
    }
  }
}
```
No thanks.


**More specific specificity**

I'm bringing !important back, yea! And all your cascades don't know how to act, yea!
Just cause, it's actually important and serves a purpose. 
What it's //not// intended for: Overriding overly specific selectors. Reversing the cascade. **Fixing bugs.**
What it //is// intended for: Pre-conceptualised styles.
The truth is, there is nothing wrong with !important. In fact at times it can save browser load speed by avoiding searching for selectors which styles are already overridden by !important (in certain cases).
Think, at the moment the grid is a pixel calculated class system, and perhaps there is a use-case scenario where we want to specify an 80% width on an element nested in a full width grid...

```
.layout__percent--80 {
  width: 80% !important;
}
```

BAM, that design faux pas which lies just slightly outside of the grid but is all important can be solved without specifying a location, module, or really anything, and can be used in any scenario without a fuss.

```
.hidden {
  display: none !important;
}
```
BLIMBAM, flippin' the javascript on your global.css? Just class that shit up. ( Yea I'm talking inline styles... If it doesn't change sporatically, it should .addClass(), amirite? )


```
.Timberland {
    content: 'Yeah!';
    color: #000000;
    background: url('../sampling-one-word/into-a-track.jpg') repeat !important;
}
.me {
  color: #ffffff;
  &:before {
    background: none;
  }
  &.me--bringing {
    background: url('../sexy.png'); 
  }
  &:after {
    .Timberland;
  }
}
.them {
  .them__other {
    display: inline;
  }
  .them__other--boys {
     content: 'don\'t know how to act';
  }
  &:after {
    .Timberland;
  }
}
```
> NOTE: that !important styles should be used on a global level, not within any individual modules. It should have the ability to be used at any point in time, on any element, carrying a small style component specific to it's name. Two of the examples above suffice, I will let you decide.


**Layout and typography**

Of course this all means that l- and t- class prefixes will need to be revisited (proposing we duplicate these styles initially while the new conventions are adopted). Big surprise, these should be renamed as "layout" and "type".
.type will hold the styles generically applied to content areas, with modifiers not necessarily needed to be nested within or coupled by the .type class. For example the following .type is considered a stand alone class:

```
<div class="layout__center">
  <p class="type--dark">Lasagne leftovers for lunch the next day.</p>
</div>
```
> NOTE: layout and typography files to be generated.

**file layout**

There are times when it can become confusing as to which selectors sit where in a file so that more specific elements don't override each other. The idea is that the higher the level of modifier, the greater influence it should have. Let's take a look!

```
.navigation {

  /* here's my pretty cool nav list. It's has a pretty pink background colour. */
  .navigation__list {
    background: pink af;
  }  

  /* and my vertical navigation modifier just for shits and gigs */
  &.navigation--vertical  {
     .navigation__item {
       margin-bottom: 10px;
     }
  }
  
  /* OHHH SNAP, checkit: */
  .navigation__item {
    &.navigation__item--padded {
      margin: 0px 15px;
      padding: 0px 10px;
    }
  }


}
```
.navigation__item--padded takes the cake, overrides the margin in a vertical navigation and makes the world a shitty place in general. We can fix this, because we don't want to create another rule that does the same thing again just in the specific case that we want a padded item in a vertical list. Let's have another looksee:

```
.navigation {

  .navigation__list {
    background: pink af;
  }

  /* This looks legit af */
  .navigation__item {
    color: purple af;
    &.navigation__item--padded {
      display: inline;
      margin: 0px 15px;
      padding: 0px 10px;
    }
  }
  
  /* This also looks legit af */
  &.navigation--vertical  {
     .navigation__item {
       display: block;
       margin-bottom: 10px;
     }
  }

}
```

Now the more global modifier should take precedence, which is what we want. One global HTML change to adopt the styles we want, and resets back to less specific modifier styles should they be needed, and then back to the original declaration.

___

# Style Guide

So style guides are pretty important in big ass projects, and now there's an easy way to get them set up!

If you haven't already, you need to run:
```
gem install hologram 
```
Do it now, I can wait.


Next you need to add the style-guide package to your project. It's as easy as adding this to your composer.json file:

```
"require-dev": {
  "hamishLamb/style-guide": "dev-master"
}
```
then running a composer update. (at the time of this articles creation, the package was still sitting in my private account... so I trust by now I've added it to the heyday packages repo thingamajig... if not, add the below to your composer.json file in the 'repositories' section)

```
{
  "type": "git",
  "url": "https://github.com/hamishLamb/style-guide.git"
}
```

Within the package, there are two config files in the /config directory. A Gemfile and a hologram_config.yml file. Copy these files out into the root of your project. 

Now the fun part, whenever you add a new less module or typography or similar, add the following doc comment block to the top of the file:


    /*doc
    ---
    title: Alert
    name: alert
    category: basics
    ---
     ```html_example
        <div class='alert'>Hello</div>
     ``` 
    */
This creates a new block for the style guide which renders using the projects VERY OWN STYLESHEET, dayum... Each block needs a different title and name, then simply add in your html markup and bam, done, so easy.


Then, build hologram by running the following command from the root of the project (you need to do this after every change):

```
hologram
```

Next up is creating a javascript/react component page - I will get back to you on this but in the meantime feel free to keep using the basics category.

View your style guide by visiting http://project.dev/style-guide/index.html

If in doubt, read the README.md (don't read it on github because the example doc comment gets rendered as markdown and you can't copy that shiz... NEVERMIND I GONE FIXED IT).

> NOTE: the hologram config is set up for our base silverstripe setup, feel free to mess with it in your own project if it's not silverstripe, or is using a different theme etc. If in doubt, check the repo: https://github.com/trulia/hologram or ask Hamish