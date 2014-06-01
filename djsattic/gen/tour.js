﻿function TourMsg(command){			if		(command == 'dflt')	{	outmsg = "This is what it looks like after you log in to your DJsAttic.com account!";	}	else if	(command == 'upld')	{	outmsg = "Clicking this button launches an upload window that you can use to upload gigabytes of your music!";	}	else if	(command == 'lgot')	{	outmsg = "Clicking this button logs out out of DJsAttic.com.";			}	else if	(command == 'adal')	{	outmsg = "Clicking any of these '+' buttons will add the entire corresponding album to the currently selected playlist.";	}	else if	(command == 'adsg')	{	outmsg = "Clicking any of these '+' buttons will add the corresponding song to the currently selected playlist.";	}	else if	(command == 'dlsg')	{	outmsg = "Clicking any of these 'x' buttons will give you the option of permanantly deleting the corresponding song from your library.";		}	else if	(command == 'plsl')	{	outmsg = "All of your playlists are saved in this dropdown menu. Selecting a playlist from this menu allows you to play or edit its contents.";		}	else if	(command == 'pled')	{	outmsg = "Clicking this button launches an editor that allows you to alter or rename the currently selected playlist.";	}	else if	(command == 'plad')	{	outmsg = "Clicking this button will create a new untitled, empty playlist.";	}	else if	(command == 'rate')	{	outmsg = "Rate your music!<br />This dropdown menu allows you to rate each song quickly and easily.";	}	else if	(command == 'btrt')	{	outmsg = "DJsAttic.com stores minor technical information about your music as well. Displayed here is the average bitrate and whether the file has a constant(CBR) or variable(VBR) bitrate.";	}	else if	(command == 'size')	{	outmsg = "This displays the size of the selected music file (in MBs).";	}	else if	(command == 'time')	{	outmsg = "This displays the time length of the selected music file.";	}	else if	(command == 'sett')	{	outmsg = "Clicking this button launches an editor that allows you to change your personal account settings, including colors.";	}	else if	(command == 'mted')	{	outmsg = "Clicking this button launches a metadata editor that allows you to change the title, artist, album, genre, track # and comments. When these changes are saved, your library is reorganized accordingly.";	}	else if	(command == 'vgen')	{	outmsg = "This area displays all the different Genres in your library. Clicking on a Genre name reorganizes the Artist and Album lists, and displays all the songs within that Genre in the song list below. Clicking 'All Genres' will display all the songs in your library.";	}	else if	(command == 'vart')	{	outmsg = "This area displays all the different Artists (and if a Genre is specified, within the specified Genre) in your library. Clicking on an Artist name reorganizes the Album lists, and displays all the songs of that Artist (and if a Genre is specified, within the specified Genre) in the song list below.";	}	else if	(command == 'valb')	{	outmsg = "This area displays all the different Albums in your library. Clicking on an Album name reorganizes and displays all the songs within that Album in the song list below.";		}	else if	(command == 'sgen')	{	outmsg = "This scrollbar allows you to scroll up and down in the event that you have more Genres in your library than can be displayed.";		}	else if	(command == 'sart')	{	outmsg = "This scrollbar allows you to scroll up and down in the event that you have more Artists in your library than can be displayed.";		}	else if	(command == 'salb')	{	outmsg = "This scrollbar allows you to scroll up and down in the event that you have more Albums in your library than can be displayed.";		}	else if	(command == 'ssng')	{	outmsg = "This scrollbar allows you to scroll up and down in the event that you have chosen to display more Songs than can be shown.";			}	else						{	outmsg = "Welcome to DJsAttic.com!";	}	document.getElementById('tourinfo').innerHTML = outmsg;}