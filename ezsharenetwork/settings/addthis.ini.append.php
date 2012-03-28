<?php /* ;?ini charset="utf-8"?

; https://www.addthis.com/help/client-api
; TODO: http://support.addthis.com/customer/portal/articles/381275-widget-sharing

;;;
; GLOBAL CONFIGURATION
; [Possible values] :
;    * OnDomReady : 'enabled' or 'disabled'
;    * AsynchronousLoading : 'enabled' or 'disabled'
;    * CustomButtons : '' or 'none' or 'image' or 'text' or 'image|text' or 'image and text'
;    * CustomButtonsExclude : a list of service delimiter by a ',' that should not be customized
;    * ValidXHTML : 'enabled' or 'disabled' (not available yet)
;    * CustomLocalization : 'enabled' or 'disabled'
;;;
[Configuration]
LibraryURI=http://s7.addthis.com/js/250/addthis_widget.js
PublisherId=
OnDomReady=enabled
AsynchronousLoading=enabled
CustomButtons=image|text|none
CustomButtonsExclude=facebook,twitter,google
ValidXHTML=disabled
ValidXHTMLURI=http://www.addthis.com/help/client-api
CustomLocalization=disabled

;;;
; API : addtthis_config
; http://support.addthis.com/customer/portal/articles/381263-addthis-client-api-#configuration
;;;
[addthis_config]
;pubid=xa-4b6989704f3661d3
services_exclude=print
services_compact=email,facebook,twitter,more
services_expanded=facebook,twitter,linkedin,google,xing,messenger
;services_custom=[services_custom]
ui_click=true
ui_delay=500
ui_hover_direction=0
ui_open_windows=false
ui_language=fr
ui_offset_top=0
ui_offset_left=0
ui_header_color=#707173
ui_header_background=#269C9B
;ui_cobrand=Technology-Everywhere.fr
ui_use_css=true
ui_use_addressbook=false
ui_508_compliant=false
data_track_clickback=false
data_track_textcopy=false
data_ga_tracker=false

;[services_custom]
;name=
;url=
;icon=

;;;
; API : addtthis_config
; http://support.addthis.com/customer/portal/articles/381263-addthis-client-api-#configuration-sharing
;;;
[addthis_share]
;url=
;title=
;description=
;swfurl=
;width=
;height=
;screenshot=
;email_template=
;email_vars=[email_vars]
templates=[templates]
url_transforms=[url_transforms]
;shorteners=[shorteners]

;[email_vars]
;example=value

[templates]
twitter=check out {{url}} (from @te-laval.fr)

[url_transforms]
clean=true
;remove=['a_parameter_i_dislike', 'another_parameter']
;add=
;shorten=

;[shorteners]
;bitly=[shorteners_bitly]

;[shorteners_bitly]
;login=BITLY_USERNAME
;apiKey=BITLY_APIKEY

;;;
; addthis_localize : Custom Translation
; http://support.addthis.com/customer/portal/articles/381241-custom-translation
;;; 
[addthis_localize]
share_caption=Bookmark and Share
email_caption=Email a Friend
email=Email
favorites=Favorites
more=More

;;;
; ADDTHIS BUTTONS
; http://www.addthis.com/services/list
;;;
[buttons]
addthis_button[]
addthis_button[0]=facebook
addthis_button[1]=linkedin
addthis_button[2]=twitter
;addthis_button[3]=xing

;;;
; Detailled buttons
; http://support.addthis.com/customer/portal/articles/381237-third-party-buttons
; http://support.addthis.com/customer/portal/articles/125609-facebook-send-button
;;;

; [Possible values] :
;    * type : 'like' or 'send'
;    * fb:like:layout : 'button_count' or 'box_count' or 'standard'
;    * fb:like:action : 'like' or 'recommend'
;    * fb:like:send : 'true' or 'false'
;    * fb:like:width : a specific width
[facebook_button]
type=like
fb:like:layout=standard
fb:like:action=like
fb:like:send=false
;fb:like:width=

; [Possible values] :
;    * type : 'follow_native' or comment it if you don't want a specific type
;    * tw:count : 'vertical' or comment it if you don't want horizontal
[twitter_button]
;type=follow_native
;tw:count=vertical
;tw:via=YOUR TWITTER USERNAME
;tw:text=
;tw:related=
;tw:screen_name=

; [Possible values] :
;    * type : 'badge' or comment it if you don't want a specific type
;    * g:plusone:size : 'medium' or 'tall' or 'badge' or 'smallbadge' or 'large'
;    * g:plusone:count : 'true' or 'false'
;    * g:plusone:annotation : 'bubble' or 'inline' or 'none'
[google_plusone_button]
;type=badge
;g:plusone:size=medium|tall|badge|smallbadge|large
;g:plusone:count=false
;g:plusone:annotation=bubble|inline|none
;g:plusone:href=
;g:plusone:name=

; [Possible values] :
;    * type : 'respect' or comment it if you don't want a specific type
[hyves_button]
;type=respect

; [Possible values] :
;    * type : 'counter' or comment it if you don't want a specific type
[linkedin_button]
;type=counter

; [Possible values] :
;    * type : 'badge' or comment it if you don't want a specific type
[stumbleupon_button]
;type=badge

; [Possible values] :
;    * type : not available
;    * pi:pinit:layout : 'horizontal' or 'vertical'
[pinterest_button]
;type=
;pi:pinit:url=
;pi:pinit:media=
;pi:pinit:layout=vertical

; [Possible values] :
;    * type : not available
;    * 4sq:data-variant : 'wide' or comment it if you don't want a specific variant
[foursquare_button]
;type=
;4sq:data-variant=wide

*/ ?>