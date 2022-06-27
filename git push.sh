echo --------------------------------------------------------------------------
echo "Github Commit lancé !"
echo --------------------------------------------------------------------------
read -p 'Input Commit title : ' title
if test "$title"=""
then
    title=$(date +"%Y-%m-%d %Hh%M")
fi
echo "Commit title : $title"
echo --------------------------------------------------------------------------
git add .
echo "Git add Terminé !"
echo --------------------------------------------------------------------------
git commit -m "$title"
echo --------------------------------------------------------------------------
echo "Git commit Terminé !"
echo --------------------------------------------------------------------------
git push https://EmmanuelFRANCOIS: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@github.com/EmmanuelFRANCOIS/DWWM-TP_Stage.git --all
echo --------------------------------------------------------------------------
echo "Git push Terminé !"
echo --------------------------------------------------------------------------
sleep 100
